<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Rentintersimrepo\orders\CreateHelper as Order;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\Commandset::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @param  Order  $order
     * @return void
     */
    protected function schedule(Schedule $schedule, Order $order)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function (Order $order) {
            $order->startActivation();
            $order->startDeactivation();
        })->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
