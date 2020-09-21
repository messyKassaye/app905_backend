<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FaultType;
class Fault extends Model
{
    //

    public function faultType(){
        return $this->belongsTo(FaultType::class);
    }
}
