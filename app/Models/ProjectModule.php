<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModule extends Model
{
    use HasFactory;

    // Use fillable instead of guarded for better security
    protected $fillable = ['project_id', 'module_name', 'features', 'details'];

    // Define the relationship with ProjectCreate
    public function projectCreate()
    {
        return $this->belongsTo(ProjectCreate::class, 'project_id');
    }
}

