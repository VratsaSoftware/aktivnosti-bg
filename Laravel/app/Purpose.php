<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $primarykey = 'purpose_id';
    protected $guarded = ['purpose_id', 'created_at', 'updated_at'];

    public function photos(){
    	return $this->hasMany('App\Photo');
    }
}
