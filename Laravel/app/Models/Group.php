<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'group_id';
    protected $guarded    = ['group_id', 'created_at', 'updated_at', 'deleted_at'];

    public function activity()
    {
        return $this->belongsTo('App\Models\Activity', 'activity_id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'group_id');
    }
}
