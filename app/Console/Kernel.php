<?php

namespace App\Console;

use App\Console\Commands\UpdateStatistics;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        UpdateStatistics::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('statistics:update')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}
