<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'refrence',
        'model_number',
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

}
