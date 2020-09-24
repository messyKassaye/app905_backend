<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
use App\User;
use App\Fault;
class Group extends Model
{
    //
   
    public function members(){
        return $this->belongsToMany(User::class);
    }

    public function accident(){
        return $this->belongsToMany(Fault::class);
    }
}
