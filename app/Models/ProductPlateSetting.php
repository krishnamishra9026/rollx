<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPlateSetting extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'franchise_id', 'half_plate_quantity', 'full_plate_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }
}
