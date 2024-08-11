<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateTask extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','authId');
    }
}
