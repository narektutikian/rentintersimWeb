<?php

namespace App;
use App\Models\Order;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_deleted'
    ];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function scopeNetwork($query, $id)
    {
        return $query->where('supervisor_id', $id);
    }

    public function scopeMyNetwork($query, $id)
    {
        return $query->where([['supervisor_id', $id],['type', '!=', 'admin']]);
    }


    public function scopeDistributor($query, $id)
    {
        return $query->where([['supervisor_id', $id], ['level', 'Distributor']]);
    }

    public function scopeDealer($query, $id)
    {
        return $query->where([['supervisor_id', $id], ['level', 'Dealer']]);
    }

    public function scopeSubdealer($query, $id)
    {
        return $query->where([['supervisor_id', $id], ['level', 'Subdealer']]);
    }



}
