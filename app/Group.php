<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
class Group extends Model
{
    //
    public function district(){
        return $this->belongsToMany(District::class);
    }
}
