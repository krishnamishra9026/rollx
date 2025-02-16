<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        for ($i = 1; $i < 5; $i++) {
            $user                           = User::create([
                'company'                   => $faker->company(),
                'name'                      => $faker->firstname() . ' ' . $faker->lastname(),
                'email'                     => $i == 1 ? 'customer@shl.com' : $faker->unique()->safeEmail(),
                'alternate_email'           => $i == 1 ? 'alt_customer@shl.com' : $faker->unique()->safeEmail(),
                'email_verified_at'         => now(),
                'iso2'                      => 'sg',
                'dialcode'                  => '+65',
                'contact'                   => $faker->numerify('+658#7##70#'),
                'alternate_iso2'            => 'sg',
                'alternate_dialcode'        => '+65',
                'alternate_contact'         => $faker->numerify('+658#7##70#'),
                'remark'                    => "This project was a massive undertaking, and I want to commend each and every team member for their hard work, innovative thinking, and perseverance. ",
                'status'                    => true,
                'password'                  => Hash::make('password'),
                'administrator_id'          => Administrator::inRandomOrder()->first()->id,
                'remember_token'            => Str::random(10),
            ]);

            for ($j = 1; $j < 4; $j++) {
                $address                    = UserAddress::create([
                    'user_id'               => $user->id,
                    'name'                  => $faker->randomElement(['Home', 'Office', 'Restaurant', 'Warehouse', 'Hotel', 'Factory']),
                    'address'               => $faker->randomElement([

                        $faker->numberBetween(100, 999).' Cecil Street #'.$faker->numberBetween(1, 10).'-'.$j.' Gb Building',
                        $faker->numberBetween(100, 758).' Jalan Sultan '.$faker->numberBetween(1, 10).'-'.$j.' Sultan Plaza',
                        $faker->numberBetween(100, 877).' Eunos Avenue 7A 01-08', $faker->numberBetween(1, 10).' Mornington Crescent',
                        $faker->numberBetween(100, 575).' North Bridge Road 09 Peninsula Plaza',
                        $faker->numberBetween(100, 545).' Jurong East Street 21 ,'.$faker->numberBetween(1, 10).'-'.$j.' Imm Bldg'

                    ]),
                    'latitude'              => 1.3294848448934506,
                    'longitude'             => 103.89022004986296,
                    'unit_number'           => $faker->randomElement(['F-106', '#01-012', '#02-013', '#03-014', '#04-015', '#04-018']),
                    'zipcode'               => $faker->randomElement(['229921', '388365', '069542', '508988', '609601', '179098']),
                    'is_primary_address'    => $j == 1 ? true : false,
                ]);
            }
        }
    }
}
