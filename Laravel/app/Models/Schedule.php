<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
	use SoftDeletes;
	
    protected $primaryKey = 'shedule_id';
    protected $guarded = ['schedule_id', 'created_at', 'updated_at'];

    public function group(){
    	return $this->belongsTo('App\Models\Group','group_id');
    }
}
