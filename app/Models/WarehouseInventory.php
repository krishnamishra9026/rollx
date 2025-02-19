<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseInventory extends Model
{
    use HasFactory;

    protected $fillable = ['warehouse_item_id', 'cost', 'unit', 'quantity', 'date_inward', 'date_outward'];

    public function item()
    {
        return $this->belongsTo(WarehouseItem::class, 'warehouse_item_id', 'id');
    }
}
