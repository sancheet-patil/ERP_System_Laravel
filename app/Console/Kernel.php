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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->exec('php artisan down')->dailyAt('23:55')
            ->runInBackground()->evenInMaintenanceMode()->timezone('Asia/Kolkata');
        $schedule->command('daily:backupdb')->dailyAt('23:57')
            ->runInBackground()->evenInMaintenanceMode()->timezone('Asia/Kolkata');
        $schedule->exec('php artisan up')->dailyAt('00:05')
            ->runInBackground()->evenInMaintenanceMode()->timezone('Asia/Kolkata');
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
