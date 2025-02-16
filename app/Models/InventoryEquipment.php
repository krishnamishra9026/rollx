<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEquipment extends Model
{

    protected $table = 'inventory_equipments';
    use HasFactory;

    protected $fillable = [
        'equipment_name',
        'date_added',
        'remark'
    ];


    public function parts()
    {
        return $this->hasMany(InventoryEquipmentPart::class, 'inventory_equipment_id', 'id');
    }

    public function serial_nos()
    {
        return $this->hasMany(InventoryEquipmentSerialNo::class, 'inventory_equipment_id', 'id')->where("deducted", false);
    }

    public function deducted_serial_nos()
    {
        return $this->hasMany(InventoryEquipmentSerialNo::class, 'inventory_equipment_id', 'id')->where("deducted", true);
    }

}
