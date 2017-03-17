<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlName extends Model
{
    //
    use SoftDeletes;
    public function priceLists ()
    {
        return $this->hasMany('App\Models\PriceList');
    }
}
