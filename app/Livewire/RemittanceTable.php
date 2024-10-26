<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Remittance;
class RemittanceTable extends Component
{

    public $search = '';
    public function render()
    {

        $remittances = Remittance::search($this->search)->get();
        return view('livewire.remittance-table'
        , ['remittances' => $remittances]);
    }
}
