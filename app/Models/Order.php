<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $hidden = ['is_deleted'];

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function sim()
    {
        return $this->belongsTo('App\Models\Sim', 'sim_id');
    }

     public function phone()
     {
         return $this->belongsTo('App\Models\Phone', 'phone_id');
     }

    public function scopeEmployee($query, $id)
    {
        return $query->where([['created_by', $id], ['is_deleted', 0]])->orWhere('updated_by', $id);
    }

    public function scopeFilter($query, $filter)
    {
        return $query->where('status', $filter);
    }
}
