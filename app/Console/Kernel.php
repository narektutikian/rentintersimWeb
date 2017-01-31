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
        Commands\Commandset::class,
        Commands\CheckActivations::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @param  \Rentintersimrepo\orders\CreateHelper  $order
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call('Rentintersimrepo\orders\CreateHelper@startDeactivation')->everyFiveMinutes();
        $schedule->call('Rentintersimrepo\orders\CreateHelper@startActivation')->everyFiveMinutes();
        $schedule->command('queue:work', ['--daemon', '--timeout' => 60, '--sleep' => '3', '--tries' => 3])
            ->everyTenMinutes()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('logs/cron_backups_mail_' . date('Y-m-d_H-i') . '.log'));
        $schedule->command('check:activations')->everyFiveMinutes();

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
