<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdlCases extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pdl(){
        return $this->belongsTo(Pdl::class);
    }

    public function crime(){
        return $this->belongsTo(Crime::class);
    }
}
