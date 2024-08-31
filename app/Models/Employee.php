<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Employee extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'employee_id';
    public $timestamps = false;
    protected $table = 'employee';

    protected $fillable = [
        'contact_number',
        'firstname',
        'lastname',
        'middleinitial',
        'sufix',
        'password',
        'role_id',
        'status',
    ];
    protected $hidden = [
        'password',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('firstname', 'like', '%' . $value . '%')
            ->orWhere('lastname', 'like', '%' . $value . '%')
            ->orWhere('contact_number', 'like', '%' . $value . '%')
            ->orWhere('status', 'like', '%' . $value . '%')

            ->orWhere('employee_id', 'like', '%' . $value . '%')
            ->orWhere('middlleinitial', 'like', '%' . $value . '%')
            ->orWhere('sufix', 'like', '%' . $value . '%');


    }


}
