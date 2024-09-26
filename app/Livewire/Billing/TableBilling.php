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
    {   $this->generate();
        return view('livewire.billing.table-billing',
        [
            'billings' => BillingStatement::search($this->search)
            ->when($this->area, function($query){
                return $query->where('subscriptionarea_id', $this->area);
            })->get(),
            'areas' => SubscriptionArea::all(),
        ]);
    }

    public function selectBilling($id)
    {
        $this->selectedBilling = BillingStatement::find($id);
    }

    public function generate(){


        try {
            // Get all active subscriptions
            $subscriptions = Subscription::where('sn_status', 'active')->get();

            if ($subscriptions->isEmpty()) {
                $this->warn('No active subscriptions found.');
                return;
            }

            foreach ($subscriptions as $sub) {
                // Check if a billing statement already exists for next month and year
                $existingBilling = BillingStatement::where('subscription_id', $sub->subscription_id)
                    ->whereMonth('bs_billingdate', Carbon::now()->addMonth()->month) // next month
                    ->whereYear('bs_billingdate', Carbon::now()->addMonth()->year)   // same year (or next year if it's December)
                    ->first();

                if ($existingBilling) {
                    // If a billing statement already exists, log a message and skip this subscription
                        continue;
                }

                // Create a new billing statement for next month
                $billing = new BillingStatement();
                $billing->subscription_id = $sub->subscription_id;
                $billing->bs_status = 'unpaid';

                // Set the due date to 5 days after the next month's billing date
                $billing->bs_duedate = Carbon::now()->addMonth()->addDays(5)->format('Y-m-d');

                // Set the billing date to next month
                $billing->bs_billingdate = Carbon::now()->addMonth()->format('Y-m-d');

                // Save the new billing statement
                $billing->save();

                // Log success for this subscription
                    }

        } catch (Exception $e) {
            // Log the error with more details for troubleshooting
            Log::error('Error generating billing statement: ' . $e->getMessage(), [
                'subscription_id' => isset($sub) ? $sub->subscription_id : null
            ]);

                }



    }


}
