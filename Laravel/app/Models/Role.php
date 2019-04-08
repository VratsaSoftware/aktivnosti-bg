<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'role_id';
    protected $guarded    = ['role_id', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id');
    }

}
