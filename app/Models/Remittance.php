<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    protected $table = 'remittances';
    protected $primaryKey = 'remittance_id';
    protected $fillable = ['rm_amount', 'rm_date', 'rm_image', 'employee_id', 'subscriptionarea_id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function subscriptionArea()
    {
        return $this->belongsTo(SubscriptionArea::class, 'subscriptionarea_id');
    }

    public function remittanceProof()
    {
        return $this->hasOne(RemittanceProof::class, 'remittance_id');
    }

}
