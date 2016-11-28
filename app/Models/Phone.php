<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //

    protected $hidden = ['is_deleted'];

    public function sim()
    {
        return $this->belongsTo('App\Models\Sim', 'current_sim_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provide', 'provider_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }

    public function scopeFilter($query, $filter)
    {
        return $query->where('is_deleted', 0)->where('state', $filter);
    }
}
