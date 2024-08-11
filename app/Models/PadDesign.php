<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadDesign extends Model
{
    use HasFactory;
    protected $fillable = [
        'padBody','title'
    ];
}
