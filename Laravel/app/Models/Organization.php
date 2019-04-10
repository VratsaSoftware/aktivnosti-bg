<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'organization_id';
    protected $guarded    = [];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'organization_user', 'organization_id', 'user_id');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'organization_id');
    }

    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'image');
    }

    public function news()
    {
        return $this->morphMany('App\Models\Models\News', 'article');
    }

    public function newsletters()
    {
        return $this->morphMany('App\Models\Newsletters', 'desired');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
	
	public function isApproved()
    {
        return null !== $this->approved_at;
    }

}
