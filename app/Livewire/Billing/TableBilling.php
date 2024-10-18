<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\BillingStatement;
use App\Models\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\SubscriptionArea;

class TableBilling extends Component
{

    public $search;
    public $selectedBilling;


    public $area;
    public function render()
    {
        $this->generate();
        return view('livewire.billing.table-billing', [
            'billings' => BillingStatement::search($this->search)
                ->when($this->area, function ($query) {
                    return $query->whereHas('subscription.area', function ($q) {
                        $q->where('snarea_name', $this->area);
                    });
                })->get(),
            'areas' => SubscriptionArea::all(),
        ]);
    }



    public function selectBilling($id)
    {
        $this->selectedBilling = BillingStatement::find($id);
    }

    public function generate()
{
    try {
        $subscriptions = Subscription::where('sn_status', 'active')->get();

        if ($subscriptions->isEmpty()) {
            $this->warn('No active subscriptions found.');
            return;
        }

        foreach ($subscriptions as $sub) {
            // Parse the subscription's start date
            $startDate = Carbon::parse($sub->sn_startdate);
            // Calculate the next billing date (start date + 1 month)
            $nextBillingDate = $startDate->copy()->addMonth();
            // Calculate the due date as 5 days after today
            $dueDate = Carbon::now()->addDays(5);

            // Check if today is 5 days before the next billing date
            if (Carbon::now()->diffInDays($nextBillingDate, false) != 5) {
                continue;
            }

            // Check if a billing statement already exists for the subscription for this billing cycle
            $existingBilling = BillingStatement::where('subscription_id', $sub->subscription_id)
                ->whereMonth('bs_billingdate', $nextBillingDate->month)
                ->whereYear('bs_billingdate', $nextBillingDate->year)
                ->first();

            if ($existingBilling) {
                continue;
            }

            // Create a new billing statement
            $billing = new BillingStatement();
            $billing->subscription_id = $sub->subscription_id;
            $billing->bs_status = 'unpaid';
            $billing->bs_billingdate = $nextBillingDate->format('Y-m-d');
            $billing->bs_duedate = $dueDate->format('Y-m-d');
            $billing->save();
        }

        session()->flash('message', 'Billing statement generated successfully.');
    } catch (Exception $e) {
        Log::error('Error generating billing statement: ' . $e->getMessage(), [
            'subscription_id' => isset($sub) ? $sub->subscription_id : null
        ]);
    }
}

}
