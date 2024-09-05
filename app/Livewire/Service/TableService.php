<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionPlan;

class TableService extends Component
{
    public $search ="";

    public $sbandwidth;
    public $price;
    public $type;

    public $selectedService;
    public function render()
    {
        return view('livewire.service.table-service'
        , [
            'services' => SubscriptionPlan::search($this->search)->paginate(10)
        ]);
    }

    public function selectService($id)
    {
        $this->selectedService = SubscriptionPlan::find($id);
        $this->sbandwidth = $this->selectedService->bandwidth;
        $this->price = $this->selectedService->subscription_fee;
    }

    public function deleteService()
    {
        if($this->selectedService)
        {
            $this->selectedService->delete();
        }
    }

    public function updateService()
    {

        $this->validate([
            'sbandwidth' => 'required',
            'price' => 'required',
        ]);
        $this->selectedService->update([
            'bandwidth' => $this->sbandwidth,
            'subscription_fee' => $this->price,
        ]);
    }

}
