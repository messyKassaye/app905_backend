<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
class DistrictControllingArea extends Model
{
    //

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function woreda(){
        return $this->hasMany(DistrictWoreda::class);
    }

    public function specificName(){
        return $this->hasMany(SpecificName::class);
    }
    
}
