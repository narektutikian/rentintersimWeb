<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //

    protected $hidden = ['is_deleted'];

    public function provider(){
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
    public function scopeFilter($query, $filter)
    {
        return $query->where('is_deleted', 0)->where('status', $filter);
    }
}
