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
        'available_quantity',
        'sold_quantity',
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }

    public function franchise_orders($franchise_id)
    {
        return $this->hasMany(Order::class, 'product_id', 'id')->where('franchise_id', $franchise_id);
    }

    public function franchise_sales($franchise_id)
    {
        return $this->hasMany(Sale::class, 'product_id', 'id')->where('franchise_id', $franchise_id);
    }

    public function franchises()
    {
        return $this->belongsToMany(Franchise::class, 'product_prices');
    }

}
