<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingStatement extends Model
{
    protected $table = 'billingstatements';
    protected $primaryKey = 'billstatement_id';
    protected $fillable = ['subscription_id', 'bs_amount', 'bs_billingdate', 'bs_duedate', 'bs_status'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'billstatement_id');
    }
}
