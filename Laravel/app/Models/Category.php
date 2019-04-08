<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'category_id';
    protected $guarded    = ['category_id', 'created_at', 'updated_at', 'deleted_at'];

    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }

    public function activities()
    {
        return $this->belongsToMany('App\Models\Activity', 'activity_category', 'category_id', 'activity_id');
    }

    public function news()
    {
        return $this->morphMany('App\Models\News', 'article');
    }

    public function newsletters()
    {
        return $this->morphMany('App\Models\Newsletter', 'desired');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'category_user', 'category_id', 'user_id');
    }
}
