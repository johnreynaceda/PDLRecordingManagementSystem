<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDescription extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pdl(){
        return $this->belongsTo(Pdl::class);
    }
}
