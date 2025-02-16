<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipment_id',
        'job_type_id',
        'technician_id',
        'description',
        'user_address_id',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'remark',
        'free_of_cost',
        'add_on_calendar',
        'status',
        'current_latitude',
        'current_longitude',
        'technician_remark',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(JobImage::class, 'job_id', 'id');
    }

    public function replacements()
    {
        return $this->hasMany(EquipmentReplacement::class, 'job_id', 'id');
    }

    public function proof()
    {
        return $this->hasMany(JobParcelProof::class);
    }

    public function signature()
    {
        return $this->hasOne(JobParcelSignature::class);
    }
}
