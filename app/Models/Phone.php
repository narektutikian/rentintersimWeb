<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at', 'created_at'];



    public function sim()
    {
        return $this->belongsTo('App\Models\Sim', 'current_sim_id');
    }

    public function parking_sim()
    {
        return $this->belongsTo('App\Models\Sim', 'initial_sim_id');
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
        return $query->where('state', $filter);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
}
