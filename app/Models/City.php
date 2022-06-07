<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class City extends Model
{

    protected $primaryKey = 'city_id';
    protected $guarded    = ['city_id', 'created_at', 'updated_at', 'deleted_at'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function profiles()
    {
        return $this->hasMany('App\Models\Profile', 'profile_id');
    }

    public function organizations()
    {
        return $this->hasMany('App\Models\Organization', 'organization_id');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'activity_id');
    }

    public function getPlatformUrlAttribute()
    {
        $url = parse_url(URL::current());

        return 'https://' . $this->subdomain . '.' . $url['host'];
    }
}
