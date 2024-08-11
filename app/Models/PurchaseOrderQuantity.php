<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderQuantity extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function purchaseOrderQuantity(){
        return $this->belongsTo(PurchaseOrder::class,'purchase_order_id');
    }
}
