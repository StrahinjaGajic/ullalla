<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\DeactivateUser',
        'App\Console\Commands\ActivateScheduledPackages',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ullalla:deactivate-user')->dailyAt('23:55');
        $schedule->command('ullalla:activate-scheduled-packages')->dailyAt('23:56');
        $schedule->command('ullalla:add-visitors')->dailyAt('23:57');
        $schedule->command('ullalla:make-yearly-visitors')->dailyAt('23:57');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
