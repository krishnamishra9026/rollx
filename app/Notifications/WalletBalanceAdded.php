<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class WalletBalanceAdded extends Notification implements ShouldQueue
{
    use Queueable;

    public $amount;
    public $wallet_balance;

    public function __construct($amount, $wallet_balance)
    {
        $this->amount = $amount;
        $this->wallet_balance = $wallet_balance;
    }

    public function via($notifiable)
    {
        return ['database']; // Notify via email and database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Wallet Balance Updated')
            ->line('An amount of ' . number_format($this->amount, 2) . ' has been added to your wallet.')
            ->line('Your new wallet balance is: ' . number_format($this->wallet_balance, 2))
            ->action('View Wallet', url('/wallet'))
            ->line('Thank you for using our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => number_format($this->amount, 2) . ' Points added in wallet.',
            'new_balance' => number_format($this->wallet_balance, 2),
        ];
    }
}
