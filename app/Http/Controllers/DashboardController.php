<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\BillingStatement;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function displayDashboardData(){

        $revenue = Payment::all()->sum('p_amount'); 
        $outstandingBill = BillingStatement::where('bs_status', 'unpaid')->count(); 
        $subscriberCount = Subscriber::count(); 
        $newSubscriptions = Subscriber::latest()->take(5)->get(); // Fetch latest subscribers (replace with actual logic)
        $newSubscriptionCount = $newSubscriptions->count(); // Count of new subscribers

        return view('dashboard.index', compact('revenue', 'outstandingBill', 'subscriberCount', 'newSubscriptions', 'newSubscriptionCount'));
    }
}
