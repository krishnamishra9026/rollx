<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFranchise extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'franchise_id', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

}
