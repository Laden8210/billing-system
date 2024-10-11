<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\BillingStatement;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\Complaint;
use App\Models\Employee;
use App\Models\SubscriptionPlan;

use App\Models\SubscriptionArea;
use App\Models\Payment;
use App\Models\Remittance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function login(Request $request){
        if(!$request->contact || !$request->password){
            return response()->json([
                'error' => 'Invalid contact number or password'
            ]);
        }
        $subscriber = Subscriber::where('sr_contactnum', $request->contact)->first();
        if(!$subscriber){
            return response()->json([
                'error' => 'Invalid contact number'
            ]);
        }

        if($request->password != $subscriber->sr_password){
            return response()->json([

                'error' => 'Invalid password'
            ]);
        }

        return response()->json($subscriber);
    }

    public function loginEmployee(Request $request){

        if(!$request->em_contactnum || !$request->em_contactnum){
            return response()->json([
                'error' => 'Invalid employee id or password'
            ]);
        }


        $employee = Employee::where('em_contactnum', $request->em_contactnum)->first();


        if(!$employee){
            return response()->json([
                'error' => 'Invalid employee id'
            ]);
        }


        if(Hash::check($request->password, $employee->em_password)){
            return response()->json($employee);
        }

        return response()->json([
            'error' => 'Invalid password'
        ]);

    }
    public function subscriptions(Request $request)
    {
        if (!$request->subscriber_id) {
            return response()->json([
                'error' => 'Invalid subscriber id'
            ], 200);
        }

        $currentMonth = now()->format('Y-m'); // Current month
        $nextMonth = now()->addMonth()->format('Y-m'); // Next month

        // Get subscriptions for the given subscriber
        $subscriptions = Subscription::where('subscriber_id', $request->subscriber_id)
            ->with([
                'area',
                'plan',
                'subscriber',
                'billingStatements' => function ($query) use ($currentMonth, $nextMonth) {
                    $query->where(function ($query) use ($currentMonth, $nextMonth) {
                        $query->where('bs_billingdate', 'like', $currentMonth . '%')
                              ->orWhere('bs_billingdate', 'like', $nextMonth . '%'); // Filter by current and next month
                    });
                },
                'billingStatements.payments' // Eager load payments separately
            ])
            ->get()
            ->map(function ($subscription) {
                return [
                    'subscription_id' => (string) $subscription->subscription_id,
                    'subscriber_id' => (string) $subscription->subscriber_id,
                    'subscriptionarea_id' => (string) $subscription->subscriptionarea_id,
                    'subscriptionplan_id' => (string) $subscription->subscriptionplan_id,
                    'sn_num' => $subscription->sn_num,
                    'sn_startdate' => $subscription->sn_startdate,
                    'sn_status' => $subscription->sn_status,
                    'created_at' => $subscription->created_at,
                    'updated_at' => $subscription->updated_at,
                    'snarea_name' => $subscription->area ? $subscription->area->snarea_name : null,
                    'snplan_bandwidth' => $subscription->plan ? $subscription->plan->snplan_bandwidth : null,
                    'snplan_fee' => $subscription->plan ? $subscription->plan->snplan_fee : null,
                    'subscriber' => [
                        'subscriber_id' => (string) $subscription->subscriber->subscriber_id,
                        'sr_fname' => $subscription->subscriber->sr_fname,
                        'sr_lname' => $subscription->subscriber->sr_lname,
                        'sr_minitial' => $subscription->subscriber->sr_minitial,
                        'sr_suffix' => $subscription->subscriber->sr_suffix,
                        'sr_contactnum' => $subscription->subscriber->sr_contactnum,
                        'sr_street' => $subscription->subscriber->sr_street,
                        'sr_city' => $subscription->subscriber->sr_city,
                        'sr_province' => $subscription->subscriber->sr_province,
                        'sr_zipcode' => $subscription->subscriber->sr_zipcode,
                        'sr_email' => $subscription->subscriber->sr_email,
                        'sr_status' => $subscription->subscriber->sr_status,
                        'created_at' => $subscription->subscriber->created_at,
                        'updated_at' => $subscription->subscriber->updated_at,
                    ],
                    'billing_statements' => $subscription->billingStatements->map(function ($billingStatement) {
                        return [
                            'bs_duedate' => $billingStatement->bs_duedate,
                            'billing_date' => $billingStatement->bs_billingdate,
                            'bs_status' => $billingStatement->bs_status,
                            'payments' => $billingStatement->payments->map(function ($payment) {
                                return [
                                    'payment_id' => (string) $payment->payment_id,
                                    'p_amount' => $payment->p_amount,
                                    'p_month' => $payment->p_month,
                                    'p_date' => $payment->p_date,
                                ];
                            }),
                        ];
                    }),
                ];
            });

        return response()->json($subscriptions);
    }




    public function sendComplaint(Request $request)
    {

        if (!$request->subscriber_id) {
            return response()->json([
                'error' => 'Invalid subscriber id'
            ], 400);
        }

        // Validate the complaint message is provided
        if (!$request->message) {
            return response()->json([
                'error' => 'Complaint message is required'
            ], 400); // Send a 400 Bad Request response
        }

        // Create a new complaint record
        $complaint = Complaint::create([
            'subscriber_id' => $request->subscriber_id,
            'cp_message' => $request->message,
            'employee_id' => null,
            'cp_date' => now()
        ]);

        // Return the formatted response
        return response()->json([
            'message' => 'Complaint sent successfully',
            'complaint_id' => (string) $complaint->complaint_id
        ]);
    }

    public function retrieveComplaints(Request $request){

        $complaint = Complaint::with('employee')
        ->where('subscriber_id', $request->subscriber_id)->get();
        return response()->json($complaint);
    }

    public function notification(Request $request){
        return response()->json(Announcement::all());
    }

    public function getArea(){
        return response()->json(SubscriptionArea::all());
    }

    public function collections() {
        // Retrieve BillingStatement records with related models
        $billing = BillingStatement::with([
            'subscription.subscriber',
            'subscription.area',
            'subscription.plan'
        ])->get();

        // Return the billing data as a JSON response
        return response()->json($billing);
    }

    public function getOneCollection(Request $request){

        if(!$request->billstatement_id){
            return response()->json([
                'error' => 'Invalid bill statement id'
            ], 400);
        }
        $billing = BillingStatement::with([
            'subscription.subscriber',
            'subscription.area',
            'subscription.plan'
        ])->where('billstatement_id', $request->billstatement_id)->first();

        return response()->json($billing);
    }

    public function getPlan(Request $request) {
        // Check if subscription_id is provided
        if (!$request->subscription_id) {
            return response()->json([
                'error' => 'Invalid subscription plan id'
            ], 400);
        }

        // Find the subscription by id
        $subscription = Subscription::find($request->subscription_id);

        // Check if subscription exists
        if (!$subscription) {
            return response()->json([
                'error' => 'Subscription not found'
            ], 404);
        }

        // Get the plan associated with the subscription
        $plan = $subscription->plan;

        // Check if plan exists
        if (!$plan) {
            return response()->json([
                'error' => 'Plan not found for the given subscription'
            ], 404);
        }

        // Return the plan as a JSON response
        return response()->json($plan);
    }


    public function recordPayment(Request $request){

        if(!$request->billstatement_id || !$request->amount_paid || !$request->months_advanced){
            return response()->json([
                'error' => 'Invalid payment details'
            ], 400);
        }

        $billing = BillingStatement::find($request->billstatement_id);

        if(!$billing){
            return response()->json([
                'error' => 'Billing statement not found'
            ], 200);
        }

        $planFee = $billing->subscription->plan->snplan_fee;

        if($billing->bs_status == 'paid'){
            return response()->json([
                'error' => 'Billing statement is already paid'
            ], 200);
        }

        $expectedTotal = $request->months_advanced * $planFee;

        if($request->amount_paid < $expectedTotal){
            return response()->json([
                'error' => 'The provided amount is insufficient to cover the total cost for the selected months.'
            ], 200);
        }

        $payment = new Payment();
        $payment->billstatement_id = $billing->billstatement_id;
        $payment->p_amount = $planFee;
        $payment->p_month = $billing->bs_billingdate;
        $payment->employee_id = 1;
        $payment->p_date = now();
        $payment->save();

        $billing->bs_status = 'paid';

        $billing->save();

        if($request->months_advanced > 1){
            for($i = 1; $i < $request->months_advanced; $i++){
                $newBilling = new BillingStatement();
                $newBilling->subscription_id = $billing->subscription->subscription_id;
                $newBilling->bs_amount = $planFee;
                $newBilling->bs_status = 'paid';
                $newBilling->bs_billingdate = now();
                $newBilling->bs_duedate = now();
                $newBilling->save();
            }
        }

        return response()->json([
            'message' => 'Payment recorded successfully'
        ]);


    }

    public function requestOtp(Request $request)
    {


        $validatedData = $request->validate([
            'contactnumber' => 'required|string|max:12',
        ]);

        $subscriber = Subscriber::where('sr_contactnum', $validatedData['contactnumber'])->first();

        if (!$subscriber) {
            return response()->json(['error' => 'Subscriber not found'], 200);
        }

        $otp = rand(1000, 9999);


        Http::post('https://nasa-ph.com/api/send-sms', [
            'phone_number' => $subscriber->ContactNumber,
            'message' => "Your OTP code is: $otp. Please use this code to reset your password.",
        ]);


        return response()->json(['otp' => $otp, 'subscriberId' => $subscriber->subscriber_id], 200);
    }


    public function requestOtpEmployee(Request $request)
    {


        $validatedData = $request->validate([
            'contactnumber' => 'required|string|max:12',
        ]);

        $employee = Employee::where('em_contactnum', $validatedData['contactnumber'])->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 200);
        }

        $otp = rand(1000, 9999);


        Http::post('https://nasa-ph.com/api/send-sms', [
            'phone_number' => $employee->em_contactnum,
            'message' => "Your OTP code is: $otp. Please use this code to reset your password.",
        ]);


        return response()->json(['otp' => $otp, 'employeeId' => $employee->employee_id], 200);
    }

    public function changePassword(Request $request){

        $validatedData = $request->validate([
            'subscriberId' => 'required|integer',
            'password' => 'required|string|min:6',
        ]);

        $subscriber = Subscriber::find($validatedData['subscriberId']);

        if(!$subscriber){
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        $subscriber->sr_password = $validatedData['password'];
        $subscriber->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }


    public function changePasswordEmployee(Request $request){

        $validatedData = $request->validate([
            'employeeId' => 'required|integer',
            'password' => 'required',

        ]);


        $employee = Employee::find($validatedData['employeeId']);

        if(!$employee){
            return response()->json(['error' => 'Employee not found'], 200);
        }


        if (strlen($request->password) < 6) {
            return response()->json(['error' => 'Password must be at least 6 characters'], 200);
        }

        $employee->em_password = bcrypt($validatedData['password']);
        $employee->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function getRemittance(Request $request)
    {
        // Fetch all remittance records
        $remittances = Remittance::all();

        foreach ($remittances as $remittance) {

            $remittance->rm_image = asset('storage/' . $remittance->rm_image);
        }

        // Return the data as JSON response
        return response()->json($remittances);
    }

    public function changeEmployeePassword(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'new_password' => 'required|string|min:6',
            'old_password' => 'required',
        ]);



        $employee = Employee::find($validatedData['employee_id']);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 200);
        }

        if (!Hash::check($validatedData['old_password'], $employee->em_password)) {
            return response()->json(['error' => 'Invalid old password'], 200);
        }

        $employee->em_password = bcrypt($validatedData['new_password']);
        $employee->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }


    public function changeSubscriberPassword(Request $request)
    {
        $validatedData = $request->validate([
            'subscriber_id' => 'required|integer',
            'new_password' => 'required|string|min:6',
            'old_password' => 'required',
        ]);


        $subscriber = Subscriber::find($validatedData['subscriber_id']);


        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        if ($validatedData['old_password'] != $subscriber->sr_password) {
            return response()->json(['message' => 'Invalid old password'], 400);
        }


        if(!$subscriber){
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        $subscriber->sr_password = $validatedData['new_password'];
        $subscriber->save();


        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function countCollectables(Request $request)
    {
        $collectables = BillingStatement::where('bs_status', 'unpaid')->count();

        return response()->json(['collectables' => $collectables]);
    }



}
