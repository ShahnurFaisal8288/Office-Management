<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchaseOrderQuantities(){
        return $this->belongsToMany(Service::class,'purchase_order_quantity','purchase_order_id')->withPivot('amount','description');
    }
}
