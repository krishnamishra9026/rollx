<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    protected $table = 'equipments';
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'supplier_id',
        'user_id',
        'order_id',
        'user_address_id',
        'equipment_assemble_type',
        'equipment_name',
        'installation_date',
        'warranty_upto',
        'warranty_date',
        'service_contract',
        'service_start_date',
        'service_interval',
        'status',
        'quotation_reference',
        'remarks'

    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'equipment_id', 'id');
    }

    public function parts()
    {
        return $this->hasMany(EquipmentPart::class, 'equipment_id', 'id');
    }

    public function replacements()
    {
        return $this->hasMany(EquipmentReplacement::class, 'equipment_id', 'id');
    }
}
