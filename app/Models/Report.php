<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    public function order ()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function histories()
    {
        return $this->hasMany('App\Models\ReportHistory');
    }

}
