<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'header_image', 'heading', 'content', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }
}
