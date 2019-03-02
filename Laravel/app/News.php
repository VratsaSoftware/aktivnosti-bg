<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primarykey = 'news_id';
    protected $guarded = ['news_id', 'created_at', 'updated_at'];

    public function article()
    {
        return $this->morphTo();
    }

    public function photos(){
    	return $this->morphMany('App\Photo','image');
    }
}
