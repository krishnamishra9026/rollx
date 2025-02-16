<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_equipment_id',
        'part_id',
        'quantity',
        'installation_date',
        'warranty_upto',
        'replace',
        'warranty_date'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }
}
