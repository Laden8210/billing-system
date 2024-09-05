<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionArea extends Model
{
    protected $table = 'subscriptionareas';
    protected $primaryKey = 'subscriptionarea_id';
    protected $fillable = ['snarea_name'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'area_id');
    }


    public function scopeSearch($query, $value)
    {
        return $query->where('area_name', 'like', '%' . $value . '%');
    }

}



