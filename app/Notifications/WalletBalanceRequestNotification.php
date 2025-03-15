<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class WalletBalanceRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $franchise;
    protected $amount;

    public function __construct($franchise, $amount)
    {
        $this->franchise = $franchise;
        $this->amount = $amount;
    }

    public function via($notifiable)
    {
        return ['database']; // Add 'slack' or 'broadcast' if needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Wallet Balance Request')
            ->line($this->franchise->name . ' has requested a wallet top-up of $' . $this->amount)
            ->action('View Requests', url('/admin/wallet-requests'))
            ->line('Please review and approve the request.');
    }

    public function toArray($notifiable)
    {
        return [
            'franchise_name' => $this->franchise->name,
            'amount' => $this->amount,
            'message' => number_format($this->amount, 2) . ' Points requested by '.$this->franchise->firstname.' '.$this->franchise->lastname, 
            'description' => $this->franchise->firstname . ' has requested a wallet top-up of $' . $this->amount,
        ];
    }
}