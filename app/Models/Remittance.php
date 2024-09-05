<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    protected $table = 'remittances';
    protected $primaryKey = 'remittance_id';
    protected $fillable = ['payment_id', 'rm_amount', 'rm_date'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function remittanceProof()
    {
        return $this->hasOne(RemittanceProof::class, 'remittance_id');
    }
}
