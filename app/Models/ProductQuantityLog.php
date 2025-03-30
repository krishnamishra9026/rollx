<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuantityLog extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'product_id', 'added_quantity', 'deducted_quantity', 'type', 'old_quantity', 'new_quantity', 'date_added'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
