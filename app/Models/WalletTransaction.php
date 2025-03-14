<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    public function wallet()
    {
        return $this->morphOne(config('wallet.wallet_model'), 'owner')->where('wallet_id')->withDefault();
    }


    public function isBalanceLow($threshold = 1.00)
    {
        return $this->wallet->balanace < $threshold;
    }

}
