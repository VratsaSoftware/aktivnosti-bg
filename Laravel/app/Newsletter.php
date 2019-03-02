<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $primarykey = 'newsletter_id';
    protected $guarded = ['newsletter_id', 'created_at', 'updated_at'];

    public function desired(){
    	return $this->morphTo();
    }

    public function subscription(){
    	return $this->belongsTo('App\Subscription');
    }
}
