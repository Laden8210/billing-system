<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $table = 'subscriptionplans';
    protected $primaryKey = 'subscriptionplan_id';
    protected $fillable = ['snplan_bandwidth', 'snplan_fee'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscriptionplan_id');
    }


    public function scopeSearch($query, $value)
    {
        return $query->where('snplan_bandwidth', 'like', '%' . $value . '%')

            ->orWhere('snplan_fee', 'like', '%' . $value . '%');

    }
}
