<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function owner(){
        return $this->belongsTo('App\User', 'employee_id');
    }

    public function creator(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function editor(){
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function sim(){
        return $this->belongsTo('App\Models\Sim', 'sim_id');
    }

     public function phone(){
            return $this->belongsTo('App\Models\Phone', 'phone_id');
        }


}
