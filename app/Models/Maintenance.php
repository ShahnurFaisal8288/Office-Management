<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function maintenancePay()
    {
        return $this->hasOne(MaintenancePay::class);
    }
}
