<?php

namespace These\Console;

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
        'These\Console\Commands\SendResultsReportCommand',
        'These\Console\Commands\GenerateTokenForMedicalCentersCommand',
        'These\Console\Commands\ImportCentersInNewsletterManagerCommand',
        'These\Console\Commands\SendDayLogsToUserCommand',
        'These\Console\Commands\backupDBTablesCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // Backup database
        $schedule->command('these:backupDBTables --tables=answers')->twiceDaily();

        // Send partial results to subscribers
        $schedule->command('these:sendResultsReport')->dailyAt('08:00');

        // Send today's logs to admin
        $schedule->command('these:SendDayLogsToUser')->dailyAt('08:30');
        $schedule->command('these:SendDayLogsToUser')->dailyAt('16:00');
        $schedule->command('these:SendDayLogsToUser')->dailyAt('23:59');
    }
}
