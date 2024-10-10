<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Remittance;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\BillingStatement;
use App\Models\Announcement;

use Illuminate\Support\Facades\Http;
use App\Models\SubscriptionArea;

class NavigationController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login.index');
    }


    public function welcome()
    {
        return view('welcome');
    }


    public function dashboard()
    {
        return view('dashboard.index');
    }


    public function userAccount()
    {
        return view('user.index');
    }

    public function service()
    {
        return view('service.index');
    }

    public function subscriber()
    {
        return view('subscriber.index');
    }

    public function subscriberById($id)
    {
        return view('subscriber.view', compact('id'));
    }

    public function billing()
    {
        return view('billing.index');
    }

    public function payment()
    {
        return view('payment.index');
    }

    public function report()
    {
        return view('report.index');
    }

    public function announcement()
    {
        return view('announcement.index');
    }

    public function complaints()
    {
        return view('complaints.index');
    }


    public function generateReport(Request $request)
    {

        $reportType = $request->reportType;
        $start = $request->start;
        $end = $request->end;
        $area = $request->area;
        $employee = $request->employee;


        if ($reportType == 'Subscriber Report') {

            $subscribers = Subscriber::whereHas('subscriptions', function ($query) use ($start, $end, $area) {

                $query->whereBetween('created_at', [$start, $end]);


                if ($area) {
                    $query->whereHas('area', function ($areaQuery) use ($area) {
                        $areaQuery->where('subscriptionarea_id', $area);
                    });
                }
            })->get();

            $areaName = SubscriptionArea::find($area)->snarea_name;

            $pdf = Pdf::loadView('report.subscriberreport', compact('subscribers', 'start', 'end', 'areaName'));
            return $pdf->stream('subscriber_report.pdf');
        } elseif ($reportType == 'Payment Report') {
            $payments = Payment::with('employee')->where('p_date', '=', $start)
            ->where('employee_id', '=', $employee)
            ->get();

            $pdf = Pdf::loadView('report.paymentreport', compact('payments', 'start', 'end'));
            return $pdf->stream('invoice.pdf');
        } elseif ($reportType == 'Remittance Report') {

            $remittances = Remittance::where('rm_date', '=',$start)->get();



            $pdf = Pdf::loadView('report.remittancereport', compact('remittances', 'start'));
            return $pdf->stream('remittance_report.pdf');
        } elseif ($reportType == 'Billing Report') {
            $billingStatements = BillingStatement::with(['subscription.subscriber', 'subscription.area', 'payments'])

                ->whereHas('subscription.area', function ($query) use ($area) {

                    $query->where('subscriptionarea_id', $area);
                })
                ->get();

            $areaName = SubscriptionArea::find($area)->snarea_name;
            $pdf = Pdf::loadView('report.billingreport', compact('billingStatements', 'start', 'end', 'areaName'));
            return $pdf->stream('billingreport.pdf');
        } elseif ($reportType == 'Announcement Report') {
            $announcement = Announcement::whereBetween('created_at', [$start, $end])->get();
            $pdf = Pdf::loadView('report.announcementreport', compact('announcement', 'start', 'end'));
            return $pdf->download('announcement.pdf');
        }elseif($reportType == 'Complaints Report'){
            $complaints = Complaint::whereBetween('cp_date', [$start, $end])
            ->get();

            $pdf = Pdf::loadView('report.complaintsreport', compact('complaints', 'start', 'end'));
            return $pdf->stream('complaints.pdf');
        }
    }

    public function generateSubscribersReport()
    {

        $subscribers = Subscriber::all();
        $pdf = Pdf::loadView('report.subscriberreport', compact('subscribers'));
        return $pdf->stream('invoice.pdf');
    }
    public function generatePaymentReport()
    {

        $payments = Payment::all();

        $pdf = Pdf::loadView('report.paymentreport', compact('payments'));
        return $pdf->stream('invoice.pdf');
    }

    public function remittanceReport()
    {
        $remittances = Remittance::all();
        $pdf = Pdf::loadView('report.remittancereport', compact('remittances'));
        return $pdf->stream('invoice.pdf');
    }
    public function complaintsreport()
    {
        $complaints = Complaint::with('subscriber')->get();
        $pdf = Pdf::loadView('report.complaintsreport', compact('complaints'));
        return $pdf->stream('complaints.pdf');
    }
    public function announcementreport()
    {
        $announcement = Announcement::all();
        $pdf = Pdf::loadView('report.announcementreport', compact('announcement'));
        return $pdf->download('announcement.pdf');
    }

    public function billingreport()
    {
        $billingStatements = BillingStatement::with(['subscription.subscriber', 'subscription.area', 'payments'])
            ->get();


        $pdf = Pdf::loadView('report.billingreport', compact('billingStatements'));
        return $pdf->stream('billingreport.pdf');
    }

    public function downloadApp()
    {

        $file = public_path('download/app.apk'); // Ensure the path is correct

        $headers = [
            'Content-Type' => 'application/vnd.android.package-archive',
        ];

        // Check if file exists before trying to download
        if (!file_exists($file)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->download($file, 'app.apk', $headers);
    }


    public function forgotPasswordPage()
    {
        return view('forgotpassword.index');
    }

    public function requestOtp(Request $request)
    {
        $request->validate([
            'phoneEmail' => 'required',
        ]);

        $phoneEmail = $request->phoneEmail;
        $otp = rand(1000, 9999);

        // Fetch the employee record based on the contact number or email
        $employee = Employee::where('em_contactnum', $phoneEmail)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Phone number not found.');
        }

        // Send OTP to the employee's phone number or email
        $response = Http::post('https://nasa-ph.com/api/send-sms', [
            'phone_number' => $phoneEmail,
            'message' => "Your OTP code is: $otp. Please use this code to reset your password.",
        ]);

        if ($response->successful()) {
            session([
                'otp' => $otp,
                'employeeId' => $employee->employee_id, // Access the employee_id
            ]);

            return redirect()->route('reset-password')->with('success', 'OTP sent successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to send OTP. Please try again.');
        }
    }

    public function resetPassword(Request $request)
    {
        return view('forgotpassword.reset-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'npassword' => 'required',
            'cpassword' => 'required',
        ]);

        $employeeId = session('employeeId');

        if (!$employeeId) {
            return redirect()->route('forgotPassword')->with('error', 'Invalid request. Please try again.');
        }

        // Validate the OTP
        if ($request->otp != session('otp')) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        $employee = Employee::find($employeeId);

        if (!$employee) {
            return redirect()->route('forgotPassword')->with('error', 'Employee not found. Please try again.');
        }

        if ($request->npassword != $request->cpassword) {
            return redirect()->back()->with('error', 'Passwords do not match. Please try again.');
        }

        $employee->update([
            'em_password' => bcrypt($request->npassword),
        ]);

        // Clear the OTP session after successful password change
        session()->forget(['otp', 'employeeId']);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
