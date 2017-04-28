<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\Account;
use App\Models\Traits\BaseObserverTrait;

class Sim extends Model
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
    protected $editable = 0;

    public function provider(){
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
    public function scopeFilter($query, $filter)
    {
        return $query->where('state', $filter);
    }
}
