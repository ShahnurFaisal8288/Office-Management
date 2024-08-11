<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPermissionsTrait;

class Employee extends Model
{
    use HasFactory, HasPermissionsTrait;
    protected $guarded = [];
    public function investors()
    {
        return $this->belongsToMany(Investor::class,'employee_investor','investor_id', 'employee_id');
    }
    public function Permission(){
        return $this->hasMany(Permission::class);
    }
    public function role(){
        return $this->belongsTo(Role::class,'user_role');
    }
    public function salary(){
        return $this->hasOne(Salary::class);
    }
}
