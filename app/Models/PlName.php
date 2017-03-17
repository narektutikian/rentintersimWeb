<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlName extends Model
{
    //
    public function priceLists ()
    {
        return $this->hasMany('App\Models\PriceList');
    }
}
