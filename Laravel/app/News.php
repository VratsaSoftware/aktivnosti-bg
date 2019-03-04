<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
	use SoftDeletes;
	
    protected $primaryKey = 'news_id';
    protected $guarded = ['news_id', 'created_at', 'updated_at', 'deleted_at'];

    public function article()
    {
        return $this->morphTo();
    }

    public function photos(){
    	return $this->morphMany('App\Photo','image');
    }
}
