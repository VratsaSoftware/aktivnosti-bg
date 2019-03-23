<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'activity_id';
    protected $guarded    = ['activity_id', 'created_at', 'updated_at', 'deleted_at'];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'image');
    }

    public function groups()
    {
        return $this->hasMany('App\Models\Group', 'activity_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function news()
    {
        return $this->morphMany('App\Models\News', 'article');
    }

    public function newsletters()
    {
        return $this->morphMany('App\Models\Newsletter');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

}
