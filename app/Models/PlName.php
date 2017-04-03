<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlName extends Model
{
    //
    use SoftDeletes;

    protected $events = [
        'saved',
        'deleted',
        'updated'
    ];

    public function priceLists ()
    {
        return $this->hasMany('App\Models\PriceList');
    }
    public function users ()
    {
        return $this->belongsToMany('App\User');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
    public function plCost()
    {
        return $this->belongsTo('App\Models\PlName', 'cost_pl_name_id');
    }
}
