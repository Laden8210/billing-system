<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'subscription_plan';
    protected $primaryKey = 'subscription_plan_id';
    protected $fillable = ['bandwith', 'subscription_fee'];

    public function scopeSearch($query, $value)
    {
        return $query->where('bandwith', 'like', '%' . $value . '%')

            ->orWhere('subscription_fee', 'like', '%' . $value . '%');

    }
}
