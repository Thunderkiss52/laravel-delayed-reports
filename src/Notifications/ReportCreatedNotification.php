<?php
namespace Thunderkiss52\LaravelDelayedReport\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderkiss52\LaravelDelayedReport\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ReportCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public static string $label = "Отчёт создан";

    /**
     * Create a new notification instance.
     */
    public function __construct(private Report $report)
    {
        //
    }
    private function text()
    {
        return "Отчёт {$this->report->label} на ".$this->report->execute_at->format('d.m.y h:i:s')." создан и отправлен на почту {$this->report->email}";
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'label' => self::$label,
            'data' => $this->toArray($notifiable),
            //'read_at' => $this->read_at,
            'created_at' => new Carbon()
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'text' => $this->text()
        ];
    }
}
