<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    protected $order_url;

    public function __construct($order, $order_url)
    {
        $this->order = $order;
        $this->order_url = $order_url;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    // Build the notification data
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_status' => $this->order->status ?? 'pending',
            'message' => 'Order Status changed to ' . ucfirst($this->order->status),
            'order_url' => $this->order_url,
        ];
    }

    
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
