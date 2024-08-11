<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenancePay extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function maintenances(){
        return $this->belongsTo(Maintenance::class,'maintenance_id');
    }
}
