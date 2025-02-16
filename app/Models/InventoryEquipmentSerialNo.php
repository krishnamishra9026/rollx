<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEquipmentSerialNo extends Model
{
    use HasFactory;

    protected $table = 'inventory_equipment_serial_nos';
    protected $fillable = [
        'inventory_equipment_id',
        'serial_no',
        'deducted',
        'replaced'
    ];


}
