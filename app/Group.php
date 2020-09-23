<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
use App\User;
class Group extends Model
{
    //
   
    public function members(){
        return $this->belongsToMany(User::class);
    }
}
