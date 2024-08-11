<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainHosting extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function domain(){
        return $this->belongsTo(Domain::class,'domain_id');
    }
    public function hosting(){
        return $this->belongsTo(Hosting::class,'hosting_id');
    }
}
