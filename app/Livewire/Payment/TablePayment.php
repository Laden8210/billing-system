<?php

namespace App\Livewire\Payment;

use Livewire\Component;

use App\Models\BillingStatement;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Models\SubscriptionArea;
use Illuminate\Support\Facades\Auth;
class TablePayment extends Component
{
    public $search;
    public $selectedBilling;

    public $amount;
    public $totalMonth;
    public function render()
    {
        return view(
            'livewire.payment.table-payment',
            [
                'billings' => BillingStatement::search($this->search)->get(),
                'area' => SubscriptionArea::all()
            ]
        );
    }

    public function selectBilling($id)
    {
        $this->selectedBilling = BillingStatement::find($id);
    }

    public function recordPayment()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',
            'totalMonth' => 'required|numeric|min:1'
        ]);

        $planFee = $this->selectedBilling->subscription->plan->snplan_fee;
        $expectedTotal = $this->totalMonth * $planFee;

        if ($this->amount < $expectedTotal) {
            session()->flash('error', 'The provided amount is insufficient to cover the total cost for the selected months.');
            return;
        }

        $user = Auth::user();




        if ($this->selectedBilling) {

            $payment = new Payment();
            $payment->billstatement_id = $this->selectedBilling->billstatement_id;
            $payment->p_amount = $this->selectedBilling->subscription->plan->snplan_fee;
            $payment->p_month = $this->selectedBilling->bs_billingdate;
            $payment->employee_id = $user->employee_id;
            $payment->p_date = now();
            $payment->save();


            $this->selectedBilling->bs_status = 'paid';
            $this->selectedBilling->save();
        }

        if ($this->totalMonth > 1) {

            for ($i = 1; $i < $this->totalMonth; $i++) {
                $billing = new BillingStatement();
                $billing->subscription_id = $this->selectedBilling->subscription->subscription_id;
                $billing->bs_amount = $this->selectedBilling->subscription->plan->snplan_fee;
                $billing->bs_status = 'paid'; // Mark as paid
                $billing->bs_duedate = Carbon::now()->addMonths($i)->addDays(5)->format('Y-m-d');
                $billing->bs_billingdate = Carbon::now()->addMonths($i)->format('Y-m-d');
                $billing->save();

                $payment = new Payment();
                $payment->billstatement_id = $billing->billstatement_id;
                $payment->p_amount = $billing->bs_amount;
                $payment->p_month = $billing->bs_billingdate;
                $payment->employee_id =  $user->employee_id;
                $payment->p_date = now();
                $payment->save();
            }
        }

        session()->flash('message', 'Payment recorded successfully.');
    }
}
