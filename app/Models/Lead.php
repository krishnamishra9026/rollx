<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\Admin\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Lead extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'fax',
        'admin_id',
        'remarks',
        'firstname',
        'lastname',
        'email',
        'email_additional',
        'dialcode',
        'phone',
        'alternate_phone' ,
        'alternate_dialcode' ,
        'helpline_phone' ,
        'helpline_dialcode' ,
        'password',
        'avatar',
        'gender',
        'address',
        'city',
        'state',
        'zipcode',
        'iso2',
        'status',
        'next_call_datetime',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'supplier_id', 'id');
    }

    public function purchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::class, 'supplier_id', 'id');
    }

}
