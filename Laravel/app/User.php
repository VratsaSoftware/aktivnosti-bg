<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'updated_at','approved_at','deleted_by','role_id', 'city_id', 'phone', 'family', 'updated_by', 'address',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function organization(){
        return $this->belongsTo('App\Organization');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function photo(){
        return $this->morphOne('App\Photo','image');
    }

}
