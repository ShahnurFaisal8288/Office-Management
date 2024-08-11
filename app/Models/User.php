<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    public function UserVerify()
    {
        return $this->hasOne(UserVerify::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Set the serial number starting from 10000
            $model->serial_number = self::generateSerialNumber();
        });
    }

    private static function generateSerialNumber()
    {
        // Get the maximum serial number from the database and increment it
        $maxSerialNumber = self::max('serial_number') ?? 1023;
        return $maxSerialNumber + 1;
    }

}
