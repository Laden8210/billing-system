<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
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

    public $search ="";

    public function render()
    {
        return view('livewire.user-account-table', [
            'employees' => Employee::search($this->search)->get(),
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

        $role = Role::where('role_name', $this->role)->first();
        $user = new Employee();
        $user->contact_number = $this->contact_number;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->middlleinitial = $this->middlleinitial ?? '';
        $user->sufix = $this->sufix ?? '';
        $user->password = bcrypt($this->password);
        $user->status = 'Active';
        $user->role_id = $role->role_id;
        $user->save();


        session()->flash('message', 'User created successfully');
    }
}
