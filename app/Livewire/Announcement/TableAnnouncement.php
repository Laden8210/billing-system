<?php

namespace App\Livewire\Announcement;

use Livewire\Component;
use App\Models\Announcement;
class TableAnnouncement extends Component
{

    public $search = '';
    public function render()
    {
        return view('livewire.announcement.table-announcement',
            [
                'announcements' => Announcement::search($this->search)->paginate(10)
            ]
    );
    }
}
