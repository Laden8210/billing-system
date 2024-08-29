<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionPlan;

class TableService extends Component
{
    public $search ="";
    public function render()
    {
        return view('livewire.service.table-service'
        , [
            'services' => SubscriptionPlan::search($this->search)->paginate(10)
        ]);
    }
}
