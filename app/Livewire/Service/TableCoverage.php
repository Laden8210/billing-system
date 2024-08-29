<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionArea;

class TableCoverage extends Component
{

    public $search;

    public function render()
    {
        return view('livewire.service.table-coverage', [
            'coverages' => SubscriptionArea::search($this->search)->paginate(10)
        ]);
    }
}
