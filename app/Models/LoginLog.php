<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model {
    use HasFactory;

    protected $fillable = ['admin_id', 'franchise_id', 'chef_id', 'user_type', 'ip_address', 'login_time'];

    public function admin() {
        return $this->belongsTo(Administrator::class);
    }

    public function franchise() {
        return $this->belongsTo(Franchise::class);
    }

    public function chef() {
        return $this->belongsTo(Chef::class);
    }
}
