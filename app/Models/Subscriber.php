<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'subscribers';
    protected $primaryKey = 'subscriber_id';
    protected $fillable = [
        'sr_fname', 'sr_lname', 'sr_minitial', 'sr_suffix',
        'sr_contactnum', 'sr_street', 'sr_city', 'sr_province',
        'sr_password', 'sr_status'
    ];

    protected $hidden = [
        'sr_password'
    ];

    public function scopeSearch($query, $value)
    {
        return $query->where('sr_fname', 'like', '%' . $value . '%')
            ->orWhere('sr_lname', 'like', '%' . $value . '%')
            ->orWhere('sr_minitial', 'like', '%' . $value . '%')
            ->orWhere('sr_suffix', 'like', '%' . $value . '%')
            ->orWhere('sr_contactnum', 'like', '%' . $value . '%')
            ->orWhere('sr_street', 'like', '%' . $value . '%')
            ->orWhere('sr_city', 'like', '%' . $value . '%')
            ->orWhere('sr_province', 'like', '%' . $value . '%');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscriber_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'subscriber_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'subscriber_id');
    }
}
