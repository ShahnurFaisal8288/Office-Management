<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Set the serial number starting from 2500
            $model->serial_number = self::generateSerialNumber();
        });
    }
    public function investorPay()
    {
        return $this->hasMany(InvestorPay::class);
    }
    private static function generateSerialNumber()
    {
        $prefix = 'icicle';
        $lastGeneratedSerial = self::where('serial_number', 'like', $prefix . '%')->latest('created_at')->value('serial_number');

        if (!$lastGeneratedSerial) {
            // If no previous serial number is found, start from 'CS2500'
            return $prefix . '20241';
        }

        // Extract the numeric part and increment
        $nextSerialNumber = $prefix . (intval(substr($lastGeneratedSerial, strlen($prefix))) + 1);

        return $nextSerialNumber;
    }
}
