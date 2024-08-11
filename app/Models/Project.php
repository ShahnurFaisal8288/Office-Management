<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public function projectModules()
    // {
    //     return $this->belongsToMany(ProjectModule::class, 'module_projects')
    //     ->withPivot('features','details','hours','employee_id');
    // }
    public function modules()
    {
        return $this->belongsToMany(ProjectModule::class, 'project_details','project_id')
            ->withPivot('features', 'hours', 'details', 'employee_id');
    }
    public function project(){
        return $this->belongsTo(ProjectCreate::class ,'projectCreate_id');
    }
    public function projectDetails(){
        return $this->belongsTo(ProjectDetails::class ,'project_id','project_module_id');
    }
}
