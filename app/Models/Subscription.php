<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $primaryKey = 'subscription_id';
    protected $fillable = [
        'subscriber_id', 'area_id', 'subscriptionplan_id', 'subscriptionarea_id',
        'sn_num', 'sn_startdate', 'sn_status', 'snplan_bandwidth'
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }

    public function area()
    {
        return $this->belongsTo(SubscriptionArea::class, 'subscriptionarea_id');
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscriptionplan_id');
    }

    public function billingStatements()
    {
        return $this->hasMany(BillingStatement::class, 'subscription_id');
    }
}
