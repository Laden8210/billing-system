<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;

class UserAccountTable extends Component
{

    public $contact_number;
    public $firstname;
    public $lastname;
    public $middlleinitial;
    public $sufix;
    public $password;
    public $confirm_password;
    public $role;

    public $user_id;

    public $search ="";

    public $status;

    public function render()
    {
        return view('livewire.user-account-table', [
            'employees' => Employee::search($this->search)
            ->when($this->status, function($query){
                return $query->where('em_status', $this->status);
            })
            ->get(),
        ]);
    }

    public function createUser(){

        $this->validate([
            'contact_number' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role' => 'required',

        ]);


        $employee = new Employee();
        $employee->em_contactnum = $this->contact_number;
        $employee->em_fname = $this->firstname;
        $employee->em_lname = $this->lastname;
        $employee->em_minitial = $this->middlleinitial;
        $employee->em_suffix = $this->sufix;
        $employee->em_password = bcrypt($this->password);
        $employee->em_role = $this->role;
        $employee->em_status = 'Active';
        $employee->save();

        session()->flash('message', 'User created successfully');
    }

    public function changeStatus($id){
        $employee = Employee::find($id);
        $employee->em_status = $employee->em_status == 'Active' ? 'Inactive' : 'Active';
        $employee->save();
    }

    public function viewUser($id){
        $employee = Employee::find($id);
        $this->user_id = $id;
        $this->contact_number = $employee->em_contactnum;
        $this->firstname = $employee->em_fname;
        $this->lastname = $employee->em_lname;
        $this->middlleinitial = $employee->em_minitial;
        $this->sufix = $employee->em_suffix;
        $this->role = $employee->em_role;

    }

    public function updateUser(){


        $employee = Employee::find($this->user_id);
        $employee->em_contactnum = $this->contact_number;
        $employee->em_fname = $this->firstname;
        $employee->em_lname = $this->lastname;
        $employee->em_minitial = $this->middlleinitial;
        $employee->em_suffix = $this->sufix;
        $employee->em_role = $this->role;
        $employee->save();

        session()->flash('message', 'User updated successfully');
    }
}
