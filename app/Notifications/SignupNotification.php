<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignupNotification extends Notification
{
    use Queueable;

    public $exhibitor;
    /**
     * Create a new notification instance.
     */
    public function __construct($exhibitor)
    {
        $this->exhibitor = $exhibitor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Exhibitor Signup Notification')
                    ->line('Welcome Administrator')
                    ->line('A New Exhibitor just signed up on the platform.')
                    ->line('You can check the exhibitor by clicking on the button below')
                    ->action('View Exhibitor', route('admin.suppliers.show', $this->exhibitor->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
