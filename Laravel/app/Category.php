<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'category_id';
    protected $guarded = ['category_id', 'created_at', 'updated_at', 'deleted_at'];

    public function subcategories(){
    	return $this->hasMany('App\Category');
    }

    public function activities(){
    	return $this->hasMany('App\Activity');
    }

    public function news(){
    	return $this->morphMany('App\News','article');
    }

    public function newsletters(){
    	return $this->morphMany('App\Newsletter','desired');
    }

    public function users(){
    	return $this->belongsToMany('App/User');
    }
}
