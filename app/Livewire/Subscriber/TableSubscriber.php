<?php

namespace App\Livewire\Subscriber;

use Livewire\Component;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use App\Models\SubscriptionArea;

class TableSubscriber extends Component
{

    public $first_name;
    public $last_name;
    public $middle_name;
    public $suffix;
    public $contact_number;
    public $street;
    public $city;
    public $province;
    public $status;

    public $search = '';
    public function render()
    {
        return view('livewire.subscriber.table-subscriber',
            [
                'subscribers' => Subscriber::search($this->search)
                ->when($this->status, function($query){
                    return $query->where('sr_status', $this->status);
                })->get(),
                'areas' => SubscriptionArea::all()
            ]
        );
    }
    public function save()
    {
        $this->validate([
            'first_name' => [
                'required',
                'regex:/^[a-zA-Z]+$/'
            ],
            'last_name' => [
                'required',
                'regex:/^[a-zA-Z]+$/'
            ],
            'middle_name' => [
                'required',
                'regex:/^[a-zA-Z]+$/'
            ],
            'suffix' => [
                'nullable',
                'regex:/^[a-zA-Z]+$/'
            ],

            'contact_number' => [
                'required',
                'numeric',
                'regex:/^(09)\d{9}$/',
                'unique:subscribers,sr_contactnum'
            ],
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
        ]);
        $password = $this->last_name . substr($this->contact_number, -4);

        Subscriber::create([
            'sr_fname' => $this->first_name,
            'sr_lname' => $this->last_name,
            'sr_minitial' => $this->middle_name,
            'sr_suffix' => $this->suffix ?? '',
            'sr_contactnum' => $this->contact_number,
            'sr_street' => $this->street,
            'sr_city' => $this->city,
            'sr_province' => $this->province,
            'sr_status' => 'Active',
            'sr_datecreated' => now(),
            'sr_password' => $password,
        ]);

        $response = Http::post('https://nasa-ph.com/api/send-sms', [
            'phone_number' => $this->contact_number,
            'message' => "Hello $this->first_name $this->last_name, your account has been created. Your password is $password. Please change your password after logging in. Thank you.",
        ]);



        session()->flash('message', 'Subscriber added successfully');

        $this->reset();
    }

    public function changeStatus($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->sr_status = $subscriber->sr_status == 'Active' ? 'Inactive' : 'Active';
        $subscriber->save();
    }
}
