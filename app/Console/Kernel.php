<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('test:command')->everyMinute();
        $schedule->command('appointment:notification')->everyThirtyMinutes();
        $schedule->command('usermembership:verify')->dailyAt(0);
        $schedule->command('workout:reminder')->dailyAt(0);
        $schedule->command('meal:reminder')->hourly();
        $schedule->command('event:notification')->hourly();
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
