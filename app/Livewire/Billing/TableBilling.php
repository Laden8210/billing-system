<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\BillingStatement;

class TableBilling extends Component
{

    public $search;
    public $selectedBilling;
    public function render()
    {
        return view('livewire.billing.table-billing',
        [
            'billings' => BillingStatement::search($this->search)->get()
        ]);
    }

    public function selectBilling($id)
    {
        $this->selectedBilling = BillingStatement::find($id);
    }


}
