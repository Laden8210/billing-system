<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    protected $table = 'role';
    public $fillable = [
        'role_name',
    ];
}
