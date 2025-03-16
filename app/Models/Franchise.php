<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\Admin\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MannikJ\Laravel\Wallet\Traits\HasWallet;

class Franchise extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'fax',
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

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function product_prices()
    {
        return $this->belongsToMany(Product::class, 'product_prices');
    }

    public function products()
    {
        return $this->hasMany(ProductFranchise::class);
    }

    public function chefs()
    {
        return $this->hasMany(Chef::class, 'franchise_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function walletRequests()
    {
        return $this->hasMany(WalletRequest::class);
    }

    public function plate_settings()
    {
        return $this->hasMany(ProductPlateSetting::class);
    }

}
