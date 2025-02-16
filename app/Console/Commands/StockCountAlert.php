<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Part;
use Illuminate\Support\Facades\Mail;

class StockCountAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Stock:count-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stock count Alert via email.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch parts with quantity less than or equal to min_stock_count and notification flag is 0
        $parts = Part::where('quantity', '<=', 'min_stock_count')
                     ->where('notification', 0)
                     ->get();
    
        foreach ($parts as $part) {
            // Send email notification
            Mail::raw(
                "Stock count alert for part {$part->part}. Quantity: {$part->quantity}. Part Edit Url: " . url("admin/parts/{$part->id}/edit"),
                function ($mail) use ($part) {
                    $mail->from(env('MAIL_FROM_ADDRESS'));
                    $mail->to('AkhileshSahani48@gmail.com')->subject('Stock Count Alert');
                }
            );
    
            // Update notification flag to avoid sending duplicate alerts
            $part->notification = 1;
            $part->save();
        }
    
        $this->info('Mail sent successfully');
    }
    
}
