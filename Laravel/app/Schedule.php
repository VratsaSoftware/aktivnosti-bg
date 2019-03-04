<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
	use SoftDeletes;
	
    protected $primaryKey = 'shedule_id';
    protected $guarded = ['schedule_id', 'created_at', 'updated_at'];

    public function group(){
    	return $this->belongsTo('App\Group');
    }
}
