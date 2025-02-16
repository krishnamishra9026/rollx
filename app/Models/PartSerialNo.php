<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartSerialNo extends Model
{
    use HasFactory;
    protected $table = 'part_serial_nos';
    protected $fillable = [
        'part_id',
        'equipment_id',
        'order_id',
        'serial_no',
        'deducted',
        'replaced'
    ];
}
