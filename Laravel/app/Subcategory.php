<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
	protected $primarykey = 'subcategory_id';
    protected $guarded = ['subcategory_id', 'created_at', 'updated_at'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
    
}
