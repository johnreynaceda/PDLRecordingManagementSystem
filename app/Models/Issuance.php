<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jail(){
        return $this->belongsTo(Jail::class);
    }
}
