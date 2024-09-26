<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'em_fname', 'em_lname', 'em_minitial', 'em_suffix',
        'em_contactnum', 'em_password', 'em_role', 'em_status'
    ];


    public function scopeSearch($query, $value)
    {
        return $query->where('em_fname', 'like', '%' . $value . '%')
            ->orWhere('em_lname', 'like', '%' . $value . '%')
            ->orWhere('em_minitial', 'like', '%' . $value . '%')
            ->orWhere('em_suffix', 'like', '%' . $value . '%')
            ->orWhere('em_contactnum', 'like', '%' . $value . '%')
            ->orWhere('em_role', 'like', '%' . $value . '%')
            ->orWhere('em_status', 'like', '%' . $value . '%');
    }

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'employee_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'employee_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'employee_id');
    }
}
