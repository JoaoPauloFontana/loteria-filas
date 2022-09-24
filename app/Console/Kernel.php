<?php

namespace App\Console;

use App\Models\Result;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $numbers = [];

            for ($i=0; $i < 6; $i++) {
                $number = rand(1, 60);

                if (!in_array($number, $numbers)) {
                    $numbers[] = $number;
                }
            }

            $numbers = json_encode($numbers);

            Result::create(['numbers' => $numbers]);
        })->cron('*/30 * * * *');

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
