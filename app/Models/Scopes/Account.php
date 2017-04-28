<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 4/27/17
 * Time: 4:37 PM
 */
namespace App\Models\Scopes;
use App\Observers\BaseObserver;
trait Account
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootAccount()
    {
        static::addGlobalScope(new AccountScope);
//        static::observe(BaseObserver::class);
    }


}