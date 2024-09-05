<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemittanceProof extends Model
{
    protected $table = 'remittanceproofs';
    protected $primaryKey = 'remittanceproof_id';
    protected $fillable = ['remittance_id', 'rm_proof'];

    public function remittance()
    {
        return $this->belongsTo(Remittance::class, 'remittance_id');
    }
}
