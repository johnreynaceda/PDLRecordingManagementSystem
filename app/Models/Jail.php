<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function pdls(){
        return $this->hasMany(Pdl::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function issuances(){
        return $this->hasMany(Issuance::class);
    }
}
