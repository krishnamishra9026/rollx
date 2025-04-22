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
        'selling_type',
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
        'unit_id',
        'warehouse_inventory',
        'franchise_sale',
        'customer_sale',
        'threshold'
    ];

    protected $casts = [
        'warehouse_inventory' => 'boolean',
        'franchise_sale' => 'boolean',
        'customer_sale' => 'boolean'
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

    public function getSalePriceByFranchise($franchise_id)
    {
        if ($franchise_id) {
            $franchisePrice = $this->productFranchisePrices($franchise_id)->first();  
            return $franchisePrice ? $franchisePrice->sale_price : $this->price; 
        }

        return $this->attributes['price'];
    }

    public function productFranchisePrices($franchise_id)
    {
        return $this->hasOne(ProductPrice::class)->where('franchise_id', $franchise_id);
    }


    function getFranchiseProductTotalQuantity($franchiseId)
    {
        return Order::where('franchise_id', $franchiseId)
                    ->where('product_id', $this->id)
                    ->whereIn('status', ['completed', 'delivered'])
                    ->sum('quantity');
    }


    public function quantityLogs()
    {
        return $this->hasMany(ProductQuantityLog::class);
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
        return $this->belongsToMany(Franchise::class, 'product_franchises', 'product_id', 'franchise_id');
    }

    public function plate_setting()
    {
        return $this->hasOne(ProductPlateSetting::class, 'product_id');
    }

    public function plateSetting()
    {
        return $this->hasOne(ProductPlateSetting::class, 'product_id')->where('franchise_id', auth()->user()->id);
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id');
    }

}
