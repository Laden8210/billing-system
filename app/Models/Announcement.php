<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'announcement_id';
    protected $fillable = ['employee_id', 'an_subject', 'an_message', 'an_date'];


    public function scopeSearch($query, $value)
    {
        return $query->where('an_subject', 'like', '%'.$value.'%');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
