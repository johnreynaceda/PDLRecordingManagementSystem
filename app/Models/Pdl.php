<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdl extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class);
    }

    public function personalDescription(){
        return $this->hasOne(PersonalDescription::class);
    }

    public function emergencyContacts(){
        return $this->hasMany(EmergencyContact::class);

    }

    public function crime(){
        return $this->belongsTo(Crime::class);
    }

    public function pdlcases(){
        return $this->hasMany(PdlCases::class);
    }

    public function pdlHearings(){
        return $this->hasMany(PdlHearing::class);
    }
}
