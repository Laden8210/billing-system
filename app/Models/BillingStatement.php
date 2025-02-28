<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingStatement extends Model
{
    protected $table = 'billingstatements';
    protected $primaryKey = 'billstatement_id';
    protected $fillable = ['subscription_id', 'bs_billingdate', 'bs_duedate', 'bs_status'];
    public $timestamps = false; // Correct property name is timestamps

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'billstatement_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function area()
    {
        return $this->belongsTo(SubscriptionArea::class, 'subscriptionarea_id');
    }

    public function scopeSearch($query, $value)
    {
        return $query
            ->where('bs_billingdate', 'like', '%' . $value . '%')
            ->orWhere('bs_duedate', 'like', '%' . $value . '%')
            ->orWhere('bs_status', 'like', '%' . $value . '%')
            ->orWhereHas('subscription', function ($query) use ($value) {
                $query->where('sn_num', 'like', '%' . $value . '%')
                    ->orWhereHas('subscriber', function ($query) use ($value) {
                        $query->where('sr_fname', 'like', '%' . $value . '%')
                            ->orWhere('sr_lname', 'like', '%' . $value . '%')
                            ->orWhere('sr_minitial', 'like', '%' . $value . '%')
                            ->orWhere('sr_suffix', 'like', '%' . $value . '%')
                            ->orWhere('sr_contactnum', 'like', '%' . $value . '%')
                            ->orWhere('sr_street', 'like', '%' . $value . '%')
                            ->orWhere('sr_city', 'like', '%' . $value . '%')
                            ->orWhere('sr_province', 'like', '%' . $value . '%');
                    });
            });
    }
}
