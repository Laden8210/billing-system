<?php

namespace App\Livewire\Complaints;

use Livewire\Component;
use App\Models\Complaint;

class TableComplaints extends Component
{

    public $selectedcomplaints;

    public $reply;

    public $search = '';
    public function render()
    {
        return view('livewire.complaints.table-complaints',
        [
            'complaints' => Complaint::search($this->search)->get()
        ]
    );
    }

    public function selectComplaint($complaint_id)
    {
        $this->selectedcomplaints = Complaint::find($complaint_id);
    }

    public function replyComplaints()
    {
        $this->selectedcomplaints->cp_reply = $this->reply;
        $this->selectedcomplaints->save();
        session()->flash('message', 'Complaint replied successfully');
    }
}
