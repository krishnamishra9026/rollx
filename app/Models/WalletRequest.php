<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletRequest extends Model
{
    use HasFactory;

     protected $fillable = ['admin_id', 'franchise_id', 'amount', 'status'];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function admin()
    {
        return $this->belongsTo(Administrator::class);
    }
}
