<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAssignment extends Model
{
    protected $fillable = [
        'product_id',
        'assignment_type',
        'quantity',
        'comment',
        'assigned_by',
        'assigned_at'
    ];

    protected $casts = [
        'assigned_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function assignedByUser(): BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'assigned_by');
    }
}