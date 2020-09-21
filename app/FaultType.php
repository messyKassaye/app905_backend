<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fault;
class FaultType extends Model
{
    //

    public function accidents(){
        return $this->hasMany(Fault::class);
    }
}
