<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 4/28/17
 * Time: 9:37 AM
 */
namespace App\Models\Traits;
use App\Observers\BaseObserver;


trait BaseObserverTrait
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootBaseObserverTrait()
    {
        static::observe(BaseObserver::class);
    }


}