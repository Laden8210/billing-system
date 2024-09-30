<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionArea;

class CreateCoverage extends Component
{

    public $coverage;
    public function render()
    {
        return view('livewire.service.create-coverage');
    }

    public function store()
    {
        $this->validate([
            'coverage' => 'required'
        ]);

        $coverage = new SubscriptionArea();
        $coverage->snarea_name = $this->coverage;
        $coverage->save();

        session()->flash('message', 'Coverage successfully created.');
        $this->coverage = '';
    }


}
