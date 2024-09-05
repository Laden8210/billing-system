<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionArea;

class TableCoverage extends Component
{

    public $search;

    public $updateCoverage;
    public $selectCoverage;

    public function render()
    {
        return view('livewire.service.table-coverage', [
            'coverages' => SubscriptionArea::search($this->search)->paginate(10)
        ]);
    }

    public function selectCoverage($id){
        $this->selectCoverage = SubscriptionArea::find($id);
        $this->updateCoverage = $this->selectCoverage->area_name;

    }
}
