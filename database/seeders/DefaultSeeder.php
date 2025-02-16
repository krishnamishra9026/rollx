<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use App\Models\Quickbook;
use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobType::create([
            'type'       => 'Parts Replacement',
            'description'   => 'Parts Replacement Description' ,
        ]);

        JobType::create([
            'type'       => 'Repair',
            'description'   => 'Repairing Work' ,
        ]);

        JobType::create([
            'type'       => 'Delivery',
            'description'   => 'Delivery of equipments or parts.' ,
        ]);

        JobType::create([
            'type'       => 'Installation',
            'description'   => 'Installation of equipments.' ,
        ]);

        JobType::create([
            'type'       => 'Within warranty works',
            'description'   => 'Repairing of equipments within warranty. ' ,
        ]);

        JobType::create([
            'type'       => 'Service',
            'description'   => 'Servicing of equipments' ,
        ]);

        JobType::create([
            'type'       => 'Checking',
            'description'   => 'Checking of Equipments' ,
        ]);

        JobType::create([
            'type'       => 'Others (Includes Pressure Test, Refrigerant top up, chemical flushing, Chemical clean, etc)',
            'description'   => 'Other types means freight brokerage types; bill auditing and freight rate information services; transportation document preparation services; packing and crating and unpacking and de-crating services; freight inspection, weighing and sampling services; and freight receiving and acceptance services' ,
        ]);

        CompanySetting::create([
            'company'           => 'Shelton (S) Pte Ltd.',
            'email'             => 'info.sg@sheltonintl.com',
            'dialcode'          => '+65',
            'phone'             => '6745 5553',
            'address_line_1'    => '5A/7 Kaki Bukit Road 3',
            'address_line_2'    => 'East Point Terracer',
            'city'              => 'Payalebar',
            'zipcode'           => '417826',
            'state'             => 'East Region',
            'iso2'              => 'sg',
            'website'           => 'https://www.sheltonintl.com/',
            'logo'              => Null,
        ]);


    }
}
