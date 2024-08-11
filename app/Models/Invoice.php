<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
        public function services()
        {
            return $this->belongsToMany(Service::class,'invoice_service')->withPivot('quantity','amount','description');
        }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public static function boot()
{
    parent::boot();

    self::creating(function ($model) {
        // Set the serial number starting from 2500
        $model->invoice_no = self::generateSerialNumber();
    });
}

private static function generateSerialNumber()
{
    $prefix = 'icicle';
    $lastGeneratedSerial = self::where('invoice_no', 'like', $prefix . '%')->latest('created_at')->value('invoice_no');

    if (!$lastGeneratedSerial) {
        return $prefix . '85409214';
    }

    // Extract the numeric part and increment
    $nextSerialNumber = $prefix . (intval(substr($lastGeneratedSerial, strlen($prefix))) + 1);

    return $nextSerialNumber;
}

}
