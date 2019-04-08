<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'subcategory_id';
    protected $guarded    = ['subcategory_id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'subcategory_id');
    }

}
