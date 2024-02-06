<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pdls(){
        return $this->hasMany(Pdl::class);
    }
}
