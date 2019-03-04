<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
	use SoftDeletes;

    protected $primaryKey = 'photo_id';
    protected $guarded = ['photo_id', 'created_at', 'updated_at'];

    public function image(){
    	return $this->morphTo();
    }

    public function purpose(){
    	return $this->belongsTo('App\Purpose');
    }
}


