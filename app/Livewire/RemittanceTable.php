<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Remittance;
class RemittanceTable extends Component
{
    public function render()
    {

        $remittances = Remittance::all();
        return view('livewire.remittance-table'
        , ['remittances' => $remittances]);
    }
}
