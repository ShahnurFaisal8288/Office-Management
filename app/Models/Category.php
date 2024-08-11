<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function expense()
    {
        return $this->belongsToMany(Expense::class);
    }
    public function expenseDetails()
    {
        return $this->hasMany(ExpenseDetails::class);
    }
}
