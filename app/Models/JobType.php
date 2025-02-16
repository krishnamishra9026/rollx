<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = [       
        'type',
        'description',
        'status'
    ];

    public function job()
    {
        return $this->hasOne(Job::class, 'job_type_id', 'id');
    }
}
