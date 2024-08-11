<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCreate extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define inverse relationship
    public function projectModules()
    {
        return $this->hasMany(ProjectModule::class, 'project_id');
    }
}

