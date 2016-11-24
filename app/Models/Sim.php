<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    //
    public function provider(){
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
}
