<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderHistory extends Model
{
    use HasFactory;

    protected $fillable =[
        'purchase_order_id',
        'comment',
        'status',
        'status_changed_by',
        'status_changer_id'
    ];

    public function order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }
}
