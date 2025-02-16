<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartDocument extends Model
{
    use HasFactory;

    protected $table = 'part_documents';
    protected $fillable = ['part_id','name'];
}
