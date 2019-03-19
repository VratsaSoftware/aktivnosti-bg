<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purpose extends Model
{
	
    protected $primaryKey = 'purpose_id';
    protected $guarded = ['purpose_id', 'created_at', 'updated_at'];

    public function photos(){
    	return $this->morphMany('App\Models\Photo','image');
    }
}
