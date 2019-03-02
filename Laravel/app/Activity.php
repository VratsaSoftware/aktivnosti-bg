<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primarykey = 'activity_id';
    protected $guarded = ['activity_id', 'created_at', 'updated_at'];

    public function organization(){
    	return $this->belongsTo('App\Organization');
    }

    public function photos(){
    	return $this->morphMany('App\Photos', 'image');
    }

    public function groups(){
    	return $this->hasMany('App\Group');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function subcategory(){
    	return $this->belongsTo('App\Subcategory');
    }

    public function news(){
    	return $this->morphMany('App\News','article');
    }

    public function newsletters(){
    	return $this->morphMany('App\Newsletter');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

}
