<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/30/16
 * Time: 7:06 PM
 */

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('number', 'App\Http\ViewComposers\NumberComposer');
        View::composer('dashboard', 'App\Http\ViewComposers\DashboardComposer');
        View::composer('user', 'App\Http\ViewComposers\UserComposer');
        View::composer('type', 'App\Http\ViewComposers\TypeComposer');
        View::composer('sim', 'App\Http\ViewComposers\SimComposer');
        View::composer('home', 'App\Http\ViewComposers\HomeComposer');



        // Using Closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}