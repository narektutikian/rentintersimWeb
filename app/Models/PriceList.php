<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    //
    use SoftDeletes;
    public function plName (){
        return $this->belongsTo('Models\PlName');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }
}
