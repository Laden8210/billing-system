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

    public $subscriptions;
    public $selectedSubscription;
    public function mount($id)
    {
        $this->subscriber = Subscriber::find($id);
        $this->subscriptions = Subscription::where('subscriber_id', $id)->get();
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
}
