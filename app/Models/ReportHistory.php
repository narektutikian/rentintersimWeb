<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    //
    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }

}
