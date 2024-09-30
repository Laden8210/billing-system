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

        return view(
            'livewire.billing.table-billing',
            [
                'billings' => BillingStatement::search($this->search)
                    ->when($this->area, function ($query) {
                        return $query->where('subscriptionarea_id', $this->area);
                    })->get(),
                'areas' => SubscriptionArea::all(),
            ]
        );
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

                $existingBilling = BillingStatement::where('subscription_id', $sub->subscription_id)
                    ->whereMonth('bs_billingdate', Carbon::now()->addMonth()->month)
                    ->whereYear('bs_billingdate', Carbon::now()->addMonth()->year)
                    ->first();

                if ($existingBilling) {

                    continue;
                }

                $billing = new BillingStatement();
                $billing->subscription_id = $sub->subscription_id;
                $billing->bs_status = 'unpaid';

                $billing->bs_duedate = Carbon::now()->addMonth()->addDays(5)->format('Y-m-d');

                $billing->bs_billingdate = Carbon::now()->addMonth()->format('Y-m-d');

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
