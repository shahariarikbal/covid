<?php

namespace App\Console;

use App\Constants\Status;
use App\Jobs\SendVaccineReminderJob;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                // Only proceed if today is a weekday (Sunday to Thursday)
                if (Carbon::now()->isSunday() || Carbon::now()->isWeekday()) {
                    // Get all vaccinations scheduled for the next day
                    $vaccinations = Vaccination::whereDate('vaccine_date', Carbon::tomorrow())->get();
        
                    // Queue a job to send the reminder email for each vaccination
                    foreach ($vaccinations as $vaccination) {
                        // Update Status field
                        $vaccination->status = Status::SCHEDULED;
                        $vaccination->save();
        
                        // Send email
                        SendVaccineReminderJob::dispatch($vaccination)->delay(now()->addSeconds(1));
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error in scheduling vaccine reminders: ' . $e->getMessage());
            }
        })->dailyAt('21:00');
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
