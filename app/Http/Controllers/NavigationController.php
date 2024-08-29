<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(){
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
}

