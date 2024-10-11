<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use Livewire\Component;
use App\Models\SubscriptionArea;
use Illuminate\Support\Facades\Auth;
class CreateAnnouncement extends Component
{



    public $an_subject;
    public $an_message;


    public function render()
    {
        return view('livewire.announcement.create-announcement', [
            'subscriptionAreas' => SubscriptionArea::all(),
        ]);
    }

    public function store()
    {


        $this->validate([
            'an_subject' => 'required',

            'an_message' => 'required',
        ]);

        Announcement::create([
            'an_subject' => $this->an_subject,
            'an_message' => $this->an_message,
            'an_date' => NOW(),
            'employee_id' => Auth::user()->employee_id,

        ]);

        session()->flash('message', 'Service created successfully.');

        $this->reset();
    }
}
