<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSaleNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    
    private $sale;
    private $to;

    public function __construct($sale, $to='admin')
    {
        $this->sale = $sale;
        $this->to = $to;
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
    public function toArray(object $notifiable): array
    {
        if($this->to == 'admin'){
            return [
                'sale_id' => $this->sale->id,
                'order_id' => $this->sale->order_id,
                'message' => "New Sale Created.",
                'sale_url' => route('admin.order.sales.index'),
                'order_url' => route('admin.order.sales.index', ['order_id' => $this->sale->order_id]),
            ];
        }else{

            return [
                'sale_id' => $this->sale->id,
                'order_id' => $this->sale->order_id,
                'message' => "New Sale Created.",
                'sale_url' => route('franchise.order.sales.index'),
                'order_url' => route('franchise.order.sales.index', ['order_id' => $this->sale->order_id]),
            ];
        }
    }
}
