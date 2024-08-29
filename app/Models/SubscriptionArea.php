<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionArea extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'subscription_area';
    protected $primaryKey = 'subscription_area_id';
    protected $fillable = ['area_name'];


    public function scopeSearch($query, $value)
    {
        return $query->where('area_name', 'like', '%' . $value . '%');
    }


}
