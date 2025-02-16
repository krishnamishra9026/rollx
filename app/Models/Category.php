<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [    
        'category_id',   
        'category',       
        'status',
        'type'
    ];

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public function parts()
    {
        return $this->hasMany(Part::class, 'category_id', 'id');
    }
}
