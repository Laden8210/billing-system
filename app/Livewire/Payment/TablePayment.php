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
                'billings' => BillingStatement::search($this->search)->orderBy('bs_status', 'desc')->get(),
                'area' => SubscriptionArea::all()
            ]
        );
    }

    public function selectBilling($id)
    {
        $this->selectedBilling = BillingStatement::find($id);
        $this->amount = $this->selectedBilling->subscription->plan->snplan_fee;
    }

    public function recordPayment()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',

        ]);



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

        $this->amount = '';

        session()->flash('message', 'Payment recorded successfully.');
    }
}
