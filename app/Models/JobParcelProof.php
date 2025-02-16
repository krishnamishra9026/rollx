<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobParcelProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',       
        'user_id',    
        'technician_id',
        'photo'
    ];    

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }   

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
