<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','authId');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function taskDetails()
    {
        return $this->hasMany(TaskDetail::class, 'task_id');
    }
    
}
