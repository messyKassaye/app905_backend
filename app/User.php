<?php

namespace App;

use App\Address;
use App\Company;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\BankAccount;
use App\District;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected  $visible = ['id','first_name','last_name','email','phone','status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */

    

    
     public function role(){
         return $this->belongsToMany(Role::class);
     }

     public function district(){
         return $this->belongsToMany(District::class);
     }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setFirstNameAttribute($value){
         $this->attributes['first_name'] = ucfirst($value);
    }

    public function setLastNameAttribute($value){
         $this->attributes['last_name'] = ucfirst($value);
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
