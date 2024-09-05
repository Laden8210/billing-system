<?php

namespace App\Livewire\SubscriptionArea;

use Livewire\Component;
use App\Models\SubscriptionArea;

class SubscriptionAreaList extends Component
{
    public $subscriptionAreas;

    public function mount()
    {
        // Initialize subscription areas list
        $this->subscriptionAreas = SubscriptionArea::all();
    }
}
