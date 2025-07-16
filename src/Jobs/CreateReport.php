<?php
namespace Thunderkiss52\LaravelDelayedReport\Jobs;


use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Thunderkiss52\LaravelDelayedReport\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Thunderkiss52\LaravelDelayedReport\Mail\ReportMail;
use Thunderkiss52\LaravelDelayedReport\Notifications\ReportCreatedNotification;


class CreateReport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Report $report)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->report->execute();
        if (!is_null($this->report->email)) {
            Mail::to($this->report->email)->send(new ReportMail($this->report));
        }
        $this->report->user->notify(new ReportCreatedNotification($this->report));
    }
}
