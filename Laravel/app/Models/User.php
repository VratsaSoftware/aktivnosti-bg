<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'updated_at', 'approved_at', 'deleted_by', 'role_id', 'city_id', 'phone', 'family', 'updated_by', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    //auth methods
    public function hasRole($role='')
    {
        return null !== $this->role()->where('role', $role)->first();
    }

    public function hasAnyRole($roles=[])
    {
        return null !== $this->role()->whereIn('role', $roles)->first();
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'Не сте оторизиран!');
        }
        return $this->hasRole($roles) || abort(401, 'Не сте оторизиран!');
    }

    public function isApproved()
    {
        return null !== $this->approved_at;
    }
    //end of auth methods
    public function organizations()
    {
        return $this->belongsToMany('App\Models\Organization', 'organization_user', 'user_id', 'organization_id');
    }

    public function groups()
    {
        return $this->hasMany('App\Models\Group', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'image');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category', 'category_user', 'user_id', 'category_id');
    }
}
