<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\BillingStatement;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\Complaint;

use App\Models\SubscriptionArea;

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

    public function subscriptions(Request $request)
    {

        if (!$request->subscriber_id) {
            return response()->json([
                'error' => 'Invalid subscriber id'
            ], 400);
        }

        $subscriptions = Subscription::where('subscriber_id', $request->subscriber_id)
            ->with(['area', 'plan'])
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

                    // Flattening area and plan details
                    'snarea_name' => $subscription->area ? $subscription->area->snarea_name : null,
                    'snplan_bandwidth' => $subscription->plan ? $subscription->plan->snplan_bandwidth : null,
                    'snplan_fee' => $subscription->plan ? $subscription->plan->snplan_fee : null
                ];
            });

        // Return the formatted response
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
            'employee_id' => 1,
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

    public function collections(){
        $billing = BillingStatement::with('subscription.subscriber')->get();
        return response()->json($billing);
    }



}
