<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(Service::class,'service_transaction');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
