<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $fillable = ['billstatement_id', 'employee_id', 'p_month', 'p_amount', 'p_date'];

    public function billingStatement()
    {
        return $this->belongsTo(BillingStatement::class, 'billstatement_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function remittance()
    {
        return $this->hasOne(Remittance::class, 'payment_id');
    }
}
