<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function modules(){
       return $this->belongsTo(ProjectModule::class,'project_module_id');
    }
    public function employee(){
       return $this->belongsTo(Employee::class,'employee_id');
    }
}
