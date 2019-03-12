<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
	use SoftDeletes;

	protected $primaryKey = 'subscription_id';
    protected $guarded = ['subscription_id', 'created_at', 'updated_at'];

    public function newsletters(){
    	return $this->hasMany('App\Models\Newsletter','subscription_id');
    }
    
}
