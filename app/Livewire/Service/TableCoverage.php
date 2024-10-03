<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\SubscriptionArea;

class TableCoverage extends Component
{

    public $search;

    public $area;
    public $selectedCoverage;

    public function render()
    {
        return view('livewire.service.table-coverage', [
            'coverages' => SubscriptionArea::search($this->search)->paginate(10)
        ]);
    }

    public function selectCoverage($id){
        $this->selectedCoverage = SubscriptionArea::find($id);
        $this->area = $this->selectedCoverage->snarea_name;

    }

    public function saveUpdatedCoverage(){


        $this->validate([
            'area' => 'required'
        ]);



        $coverage = SubscriptionArea::find($this->selectedCoverage->subscriptionarea_id);

        $coverage->snarea_name = $this->area;
        $coverage->save();

        session()->flash('message', 'Coverage Updated Successfully.');
    }
    public function deleteCoverage()
    {
        if ($this->selectedCoverage) {
            $id = $this->selectedCoverage->subscriptionarea_id;

            // Delete the record
            SubscriptionArea::destroy($id);

            // Reset selected coverage after deletion
            $this->selectedCoverage = null;
            $this->area = null;



            // Optionally display a success message
            session()->flash('message', 'Coverage Deleted Successfully.');
        }
    }

}
