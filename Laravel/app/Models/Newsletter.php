<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
	use SoftDeletes;
	
    protected $primaryKey = 'newsletter_id';
    protected $guarded = ['newsletter_id', 'created_at', 'updated_at'];

    public function desired(){
    	return $this->morphTo();
    }

    public function subscription(){
    	return $this->belongsTo('App\Models\Subscription','subscription_id');
    }
}
