<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleProject extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'module_projects', 'project_id', 'project_module_id');
    }
}
