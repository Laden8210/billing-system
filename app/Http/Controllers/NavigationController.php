<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NavigationController extends Controller
{
    public function index(){

        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return view('login.index');
    }

    public function dashboard(){
        return view('dashboard.index');
    }


    public function userAccount(){
        return view('user.index');
    }

    public function service(){
        return view('service.index');
    }

    public function subscriber(){
        return view('subscriber.index');
    }

    public function subscriberById($id){
        return view('subscriber.view', compact('id'));
    }

    public function billing(){
        return view('billing.index');
    }

    public function payment(){
        return view('payment.index');
    }

    public function report(){
        return view('report.index');
    }

    public function announcement(){
        return view('announcement.index');
    }

    public function complaints(){
        return view('complaints.index');
    }
    public function generateSubscribersReport()
    {


        // dd($reservations);

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
}

