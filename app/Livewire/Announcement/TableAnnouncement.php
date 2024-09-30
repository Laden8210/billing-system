<?php

namespace App\Livewire\Announcement;

use Livewire\Component;
use App\Models\Announcement;
class TableAnnouncement extends Component
{

    public $search = '';
    public $announcement;
    public $date;
    public function render()
    {
        return view('livewire.announcement.table-announcement', [
            'announcements' => Announcement::search($this->search)
                ->when($this->date, function($query) {
                    $query->where('an_date', 'like', '%' . $this->date . '%');
                })
                ->paginate(10)
        ]);
    }


    public function viewAnnouncment($id)
    {
        $this->announcement = Announcement::find($id);
     }

     public function delete($id){
        $announcement = Announcement::find($id);
        $announcement->delete();
        session()->flash('message', 'Announcement Deleted Successfully.');
     }
}
