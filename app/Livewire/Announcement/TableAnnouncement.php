<?php

namespace App\Livewire\Announcement;

use Livewire\Component;
use App\Models\Announcement;
class TableAnnouncement extends Component
{

    public $search = '';
    public $announcement;
    public $date;

    public $deleteAnnouncement;
    public function render()
    {
        return view('livewire.announcement.table-announcement', [
            'announcements' => Announcement::search($this->search)
                ->when($this->date, function($query) {
                    $query->where('an_date', 'like', '%' . $this->date . '%');
                })
                ->orderBy('an_date', 'desc') // Move this before paginate
                ->paginate(10) // Then paginate the ordered results
        ]);
    }



    public function viewAnnouncment($id)
    {
        $this->announcement = Announcement::find($id);
     }

     public function delete($id){
        $this->deleteAnnouncement = Announcement::find($id);

     }

        public function confirmDelete(){
            $this->deleteAnnouncement->delete();
            session()->flash('message', 'Announcement Deleted Successfully.');
        }
}
