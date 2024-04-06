<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use UpdateComplainCount;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('complain:generate')->daily('22:00');
        // $schedule->command('complain:manage')->everyMinute();
        // $schedule->command('complain:update')->daily('22:00');
        $schedule->command('check:complaint-threshold')->daily('22:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        
        $this->load(__DIR__.'/Commands');
        // UpdateComplainCount::class;
        require base_path('routes/console.php');
    }

    
}
