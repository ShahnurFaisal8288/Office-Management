<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorPay extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function invoices()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
