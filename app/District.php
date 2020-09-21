<?php

namespace App;
use App\DistrictControllingArea;
use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\DistrictWoreda;
use App\SpecificName;
class District extends Model
{
    //
    public function manager(){
        return $this->belongsToMany(User::class);
    }

    public function areas(){
        return $this->hasMany(DistrictControllingArea::class);
    }

    

    public function groups(){
        return $this->belongsToMany(Group::class);
    }
}
