<?php
namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InquiryNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    // Specify which channels the notification will be sent through
    public function via($notifiable)
    {
        return ['mail'];  // Can also add 'database' or 'slack'
    }

    // Define email notification content
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Inquiry Received')
                    ->greeting('Hello Admin,')
                    ->line('A new inquiry has been submitted.')
                    ->line("**Name:** {$this->inquiry->name}")
                    ->line("**Email:** {$this->inquiry->email}")
                    ->line("**Phone:** {$this->inquiry->phone}")
                    ->line("**Message:**")
                    ->line($this->inquiry->message)
                    ->action('View Inquiry', url('/admin/inquiries'))
                    ->line('Thank you for using our application!');
    }
}
