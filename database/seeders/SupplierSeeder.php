<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create( [
            'Company'           => 'Shelton',
            'firstname'         => 'Lin',
            'lastname'          => 'Wei',
            'email'             => 'supplier@shl.com',
            'email_additional'  => 'supplier_additional@shl.com',
            'dialcode'          => '+65',
            'phone'             => '+6587767705',
            'fax'             => '+6587767705',
            'alternate_dialcode'          => '+65',
                'alternate_phone'             => '851525803',
                'helpline_dialcode'          => '+65',
                'helpline_phone'             => '891525803',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'gender'            => 'Male',
            'address'           => '160 Paya Lebar Rd #03-07 Orion@Payalebar',
            'city'              => 'Payalebar',
            'zipcode'           => '409022',
            'state'             => 'East Region',
            'iso2'              => 'sg',
            'remarks'           => 'No Remarks',
            'remember_token'    => Str::random(10),
        ]);
    }
}
