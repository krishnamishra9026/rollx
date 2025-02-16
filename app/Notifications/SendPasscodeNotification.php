<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasscodeNotification extends Notification
{
    use Queueable;

    public $passcode;

    /**
     * Create a new notification instance.
     */
    public function __construct($passcode)
    {
        $this->passcode = $passcode;
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
                    ->subject('Passcode for resetting password From Echo Hyper.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Echo Hyper'))
                    ->line('We have received your request to reset your account password.')            
                    ->line('You can use the following code to recover your account') 
                    ->line('Your Passcode is: '.$this->passcode)
                    ->line('Thank you for using ' . config('app.name', 'Echo Hyper'));
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
