<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
   
	protected $primaryKey = 'city_id';
    protected $guarded = ['city_id', 'created_at', 'updated_at', 'deleted_at'];

    public function country(){
    	return $this->belongsTo('App\Country');
    }

    public function profiles(){
    	return $this->hasMany('App\Profile');
    }

    public function organizations(){
    	return $this->hasMany('App\Organization');
    }

    public function activities(){
    	return $this->hasMany('App\Activity');
    }
}
