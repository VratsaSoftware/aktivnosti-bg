<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purpose extends Model
{
	use SoftDeletes;
	
    protected $primaryKey = 'purpose_id';
    protected $guarded = ['purpose_id', 'created_at', 'updated_at'];

    public function photos(){
    	return $this->hasMany('App\Photo');
    }
}
