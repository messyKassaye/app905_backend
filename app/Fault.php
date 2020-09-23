<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FaultType;
use App\RegionWoredZoneCity;
class Fault extends Model
{
    //

    public function faultType(){
        return $this->belongsTo(FaultType::class);
    }

    public function region(){
        return $this->belongsTo(RegionWoredZoneCity::class,'region_id');
    }

    public function subcity(){
        return $this->belongsTo(RegionWoredZoneCity::class,'sub_city_zone_id');
    }

    public function woreda(){
        return $this->belongsTo(RegionWoredZoneCity::class,'woreda_city_id');
    }
}
