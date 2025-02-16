<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'email',
        'dialcode',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'zipcode',
        'state',
        'iso2',
        'website',
        'logo'
    ];   
}
