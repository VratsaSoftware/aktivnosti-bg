<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	protected $primarykey = 'subscription_id';
    protected $guarded = ['subscription_id', 'created_at', 'updated_at'];

    public function newsletters(){
    	return $this->hasMany('App\Newsletter');
    }
    
}
