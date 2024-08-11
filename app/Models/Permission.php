<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected  $guarded = [];
    
    public function roles()
    {

        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
    public function admin()
    {

        return $this->belongsToMany(AdminAuth::class, 'admins_permissions');
    }


    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id','id');
    }
    public function subModules()
    {
        return $this->belongsTo(SubModule::class, 'sub_module_id','id');
    }
}
