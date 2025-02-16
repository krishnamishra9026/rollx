<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address', 
        'latitude',
        'longitude',       
        'city',
        'country',
        'state',
        'zipcode',
        'phone',
        'unit_number',
        'is_primary_address'
    ];

    /**
     * Get the user that owns the UserAddress
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'user_address_id', 'id');
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'user_address_id', 'id');
    }

    public function job()
    {
        return $this->hasMany(Job::class, 'user_address_id', 'id');
    }
}
