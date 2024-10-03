<?php

namespace App\Livewire\Subscriber;

use Livewire\Component;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionArea;
use App\Models\Subscription;

class ViewSubscriber extends Component
{
    public $subscriber;
    public $starting_date;
    public $area;
    public $plan;
    public $subscription_number;


    public $first_name;
    public $last_name;
    public $middle_name;
    public $suffix;
    public $contact_number;
    public $street;
    public $city;
    public $province;



    public $subscriptions;
    public $selectedSubscription;
    public function mount($id)
    {
        $this->subscriber = Subscriber::find($id);
        $this->subscriptions = Subscription::where('subscriber_id', $id)->get();
        $this->first_name = $this->subscriber->sr_fname;
        $this->last_name = $this->subscriber->sr_lname;
        $this->middle_name = $this->subscriber->sr_minitial;
        $this->suffix = $this->subscriber->sr_suffix;
        $this->contact_number = $this->subscriber->sr_contactnum;
        $this->street = $this->subscriber->sr_street;
        $this->city = $this->subscriber->sr_city;
        $this->province = $this->subscriber->sr_province;
    }

    public function render()
    {
        return view(
            'livewire.subscriber.view-subscriber',
            [
                'plans' => SubscriptionPlan::all(),
                'areas' => SubscriptionArea::all()
            ]
        );


    }

    public function save(){
        $this->validate([
            'starting_date' => 'required',
            'area' => 'required',
            'plan' => 'required',
            'subscription_number' => 'required'
        ]);

        Subscription::create([
            'subscriber_id' => $this->subscriber->subscriber_id,
            'sn_startdate' => $this->starting_date,
            'subscriptionarea_id' => $this->area,
            'subscriptionplan_id' => $this->plan,
            'sn_num' => $this->subscription_number,
            'sn_status' => 'active'
        ]);

        session()->flash('message', 'Subscription added successfully');

        return redirect()->route('subscriberById', ['id' => $this->subscriber->subscriber_id]);

    }

    public function selectSubscription($id){
        $this->selectedSubscription = Subscription::find($id);
        $this->starting_date = $this->selectedSubscription->sn_startdate;
        $this->area = $this->selectedSubscription->subscriptionarea_id;
        $this->plan = $this->selectedSubscription->subscriptionplan_id;
        $this->subscription_number = $this->selectedSubscription->sn_num;
    }

    public function update(){
        $this->validate([
            'starting_date' => 'required',
            'area' => 'required',
            'plan' => 'required',
            'subscription_number' => 'required'
        ]);

        $this->selectedSubscription->update([
            'sn_startdate' => $this->starting_date,
            'subscriptionarea_id' => $this->area,
            'subscriptionplan_id' => $this->plan,
            'sn_num' => $this->subscription_number,
        ]);

        session()->flash('message', 'Subscription updated successfully');
    }

    public function deactivate($id){
        Subscription::find($id)->update(['sn_status' => 'inactive']);
        session()->flash('message-status', 'Subscription deactivated successfully');
    }
    public function activate($id){
        Subscription::find($id)->update(['sn_status' => 'active']);
        session()->flash('message-status', 'Subscription activated successfully');
    }

    public function updateUser(){

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'suffix' => 'required',
            'contact_number' => 'required',
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
        ]);
        $this->subscriber->update([
            'sr_fname' => $this->first_name,
            'sr_lname' => $this->last_name,
            'sr_minitial' => $this->middle_name,
            'sr_suffix' => $this->suffix,
            'sr_contactnum' => $this->contact_number,
            'sr_street' => $this->street,
            'sr_city' => $this->city,
            'sr_province' => $this->province,
        ]);

        session()->flash('message', 'Subscriber updated successfully');
    }
}
