<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "supplier_id",
        "project_reference",
        "model_number",
        "quantity",
        "remarks",
        "due_date",
        "order_date",
        "suplier_remarks",
        "percentage",
        "status"
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PurchaseOrderImage::class, 'purchase_order_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(PurchaseOrderDocument::class, 'purchase_order_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(PurchaseOrderHistory::class, 'purchase_order_id', 'id');
    }
}
