<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissionsTrait;

class AdminAuth extends Authenticatable
{
    use HasFactory, HasPermissionsTrait;

    // protected $table = 'admin_auths';
    protected $guarded = [];
    public function Permission(){
        return $this->hasMany(Permission::class);
    }
    public function role(){
        return $this->belongsTo(Role::class,'user_role');
    }
}