<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
//    protected $dates = ['deleted_at'];



    public function provider(){
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
    public function scopeFilter($query, $filter)
    {
        return $query->where('status', $filter);
    }
}
