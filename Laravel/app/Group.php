<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $primarykey = 'group_id';
    protected $guarded = ['group_id', 'created_at', 'updated_at'];

    public function activity(){
    	return $this->belongsTo('App\Activity');
    }

    public function schedules(){
    	return $this->hasMany('App\Schedule');
    }
}
