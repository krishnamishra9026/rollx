<?php

namespace Database\Seeders;

use App\Models\Help;
use App\Models\Technician;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);
        for ($i = 1; $i < 41; $i++) {
            $status = $i == 1 ? true : $faker->randomElement([true, false]);
            $driver = Technician::create([                
                'firstname'         => $i == 1 ? 'Alain' : $faker->firstname(),
                'lastname'          => $i == 1 ? 'Prost' : $faker->lastname(),
                'email'             => $i == 1 ? 'technician@shl.com' : $faker->unique()->safeEmail(),   
                'email_additional'  => $faker->unique()->safeEmail(),    
                'dialcode'          => $i == 1 ? '+91' : '+65',
                'phone'             => $i == 1 ? '+651525803': $faker->numerify('+656#######'),
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'remember_token'    => Str::random(10),
                'gender'            => $i == 1 ? 'Male' : $faker->randomElement(['Male', 'Female', 'Other']),
                'address'           => $i == 1 ? 'F-104, C-6 Sector 7'  : $i.' Paya Lebar Rd #03-07, Orion@Payalebar',
                'city'              => $i == 1 ? 'Noida' : $faker->randomElement(['Hougang', 'Tampines', 'Clementi', 'Yushun', 'Woodlands', 'Seletar']),
                'state'             => $i == 1 ? 'Uttar Pradesh'  : $faker->randomElement(['Central Region', 'East Region', 'North Region', 'North-East Region', 'West Region']),
                'zipcode'           => $i == 1 ? '201301' : $faker->randomElement(['40901', '40902', '40903']),
                'iso2'              => $i == 1 ? 'in' : 'sg',
                'status'            => $status,
            ]);

            Help::create([
                'technician_id' => $driver->id,
                'message'       => 'I hope this message finds you well. I am writing to report an issue with the Equipment service & kindly request your assistance in resolving it.'
            ]);
        }
    }
}
