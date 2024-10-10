<?php

namespace App\Jobs;

use App\Mail\VaccineReminderEmail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVaccineReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $vaccination;
    /**
     * Create a new job instance.
     */
    public function __construct($vaccination)
    {
        $this->vaccination = $vaccination;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            \Log::info('Vaccination date: ' . $this->vaccination->vaccine_date);
            Mail::to($this->vaccination->email)->send(new VaccineReminderEmail($this->vaccination));
        }catch(Exception $e){
            \Log::error('Failed to send vaccine reminder: ' . $e->getMessage());
        }
        
    }
}
