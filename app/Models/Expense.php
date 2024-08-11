<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
  
    public function expenseDetails()
    {
        return $this->hasMany(ExpenseDetails::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'expense_details', 'expense_id', 'category_id')
                    ->withPivot('file', 'amount');
    }
}
