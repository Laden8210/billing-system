<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';
    protected $primaryKey = 'complaint_id';
    protected $fillable = ['subscriber_id', 'employee_id', 'cp_message', 'cp_date', 'cp_reply'];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('cp_message', 'like', '%' . $search . '%')
            ->orWhere('cp_reply', 'like', '%' . $search . '%')
            ->orWhereHas('subscriber', function ($query) use ($search) {
                $query->where('sr_fname', 'like', '%' . $search . '%')
                    ->orWhere('sr_lname', 'like', '%' . $search . '%')
                    ->orWhere('sr_minitial', 'like', '%' . $search . '%')
                    ->orWhere('sr_suffix', 'like', '%' . $search . '%')
                    ->orWhere('sr_contactnum', 'like', '%' . $search . '%')
                    ->orWhere('sr_street', 'like', '%' . $search . '%')
                    ->orWhere('sr_city', 'like', '%' . $search . '%')
                    ->orWhere('sr_province', 'like', '%' . $search . '%');
            });
    }

}
