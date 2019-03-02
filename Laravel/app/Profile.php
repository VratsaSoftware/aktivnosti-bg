<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primarykey = 'profile_id';
    protected $guarded = ['profile_id', 'created_at', 'updated_at'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

    public function photo(){
    	return $this->morphOne('App\Photo','image');
    }
}
