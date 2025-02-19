<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'outlet_name',
        'description',
        'refrence',
        'model_number',
        'sold_color',
        'serial_number',
        'quantity',
        'price',
        'status',
        'notification',
    ];


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }


    public function getPriceByFranchise($franchise_id)
    {
        if ($franchise_id) {
            $franchisePrice = $this->productFranchisePrices($franchise_id)->first();  
            return $franchisePrice ? $franchisePrice->price : $this->price; 
        }

        return $this->attributes['price'];
    }

    public function productFranchisePrices($franchise_id)
    {
        return $this->hasOne(ProductPrice::class)->where('franchise_id', $franchise_id);
    }


    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function franchises()
    {
        return $this->belongsToMany(Franchise::class, 'product_prices');
    }

}
