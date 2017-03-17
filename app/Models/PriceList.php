<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    //
    public function plName (){
        return $this->belongsTo('Models\PlName');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }
}
