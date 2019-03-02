<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primarykey = 'shedule_id';
    protected $guarded = ['schedule_id', 'created_at', 'updated_at'];

    public function group(){
    	return $this->belongsTo('App\Group');
    }
}
