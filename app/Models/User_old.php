<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

    public function musics(){
        return $this->hasMany('App\Music');
    }
}
