<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\Account;
use App\Models\Traits\BaseObserverTrait;

class Provider extends Model
{
    //
    use SoftDeletes;
    use Account;
    use BaseObserverTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }
}
