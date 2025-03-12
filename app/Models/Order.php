<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
     'product_name',
     'franchise_id',
     'product_id',
     'date',
     'model_number',
     'quantity',
     'stock',
     'product_price',
     'total_price',
     'sub_total',
     'total',
     'description',
     'status',
 ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'order_id', 'id');
    }

    public function productPlateSetting()
    {
        return $this->hasOne(ProductPlateSetting::class, 'product_id', 'product_id')
                    ->where('franchise_id', auth()->user()->franchise_id);
    }
}
