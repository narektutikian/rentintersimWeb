<?php

namespace App\Providers;

use App\Models\PlName;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Models\PriceList;
use App\Observers\UserObserver;
use App\Observers\ReportObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::observe(UserObserver::class);
        PlName::observe(ReportObserver::class);
        PriceList::observe(ReportObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
