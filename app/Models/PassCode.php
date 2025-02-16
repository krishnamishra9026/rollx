<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'model',
        'code'
    ];
}
