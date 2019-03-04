<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	
	protected $primaryKey = 'country_id';
    protected $guarded = ['country_id', 'created_at', 'updated_at', 'deleted_at'];
    
    public function cities(){
    	return $this->hasMany('cities');
    }
}
