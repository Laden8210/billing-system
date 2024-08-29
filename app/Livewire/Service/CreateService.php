<?php

namespace App\Livewire\Service;

use Livewire\Component;

use App\Models\SubscriptionPlan;

class CreateService extends Component
{
    public $bandwidth;
    public $type;
    public $price;

    public function render()
    {
        return view('livewire.service.create-service');
    }

    public function store()
    {
        $this->validate([
            'bandwidth' => 'required',

            'price' => 'required',
        ]);

        SubscriptionPlan::create([
            'bandwith' => $this->bandwidth,
            'subscription_fee' => $this->price,
        ]);

        session()->flash('message', 'Service created successfully.');

        $this->reset();
    }
}
