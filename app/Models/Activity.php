<?php
namespace App\Models;
use App\Scopes\CityScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        return $this->morphMany('App\Models\Newsletter', 'desired');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($activity) {
            // $activity->groups()->shedules()->delete();
            foreach ($activity->groups as $group) {
                $group->delete();
            }
        });

        static::addGlobalScope(new CityScope);
    }

    public function isApproved()
    {
        return null !== $this->approved_at;
    }

}
