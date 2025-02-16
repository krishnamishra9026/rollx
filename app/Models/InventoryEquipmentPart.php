<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEquipmentPart extends Model
{
    use HasFactory;
    protected $table = 'inventory_equipment_parts';
    protected $fillable = [
        'inventory_equipment_id',
        'part_id',
        'quantity',
    ];

    public function equipment()
    {
        return $this->belongsTo(InventoryEquipment::class, 'inventory_equipment_id', 'id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }
}
