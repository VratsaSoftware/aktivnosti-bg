<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'organization_id';
    protected $guarded = ['organization_id', 'created_at', 'updated_at'];

    public function users(){
    	return $this->hasMany('App\User');
	}

	public function activities(){
    	return $this->hasMany('App\Activity');
    }

    public function photos(){
    	return $this->morphMany('App\Photo','image');
    }

    public function news(){
    	return $this->morphMany('App\News','article');
    }

    public function newsletters(){
    	return $this->morphMany('App\Newsletters','desired');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

}

	

	