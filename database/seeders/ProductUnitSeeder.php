<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductUnit;

class ProductUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'name' => 'Kilogram',
                'abbreviation' => 'KG',
                'description' => 'Standard unit of mass/weight',
                'status' => 1
            ],
            [
                'name' => 'Gram',
                'abbreviation' => 'g',
                'description' => '1/1000 of a kilogram',
                'status' => 1
            ],
            [
                'name' => 'Piece',
                'abbreviation' => 'Pc',
                'description' => 'Individual unit count',
                'status' => 1
            ],
            [
                'name' => 'Packet',
                'abbreviation' => 'Pkt',
                'description' => 'Standard packet quantity',
                'status' => 1
            ],
            [
                'name' => 'Litre',
                'abbreviation' => 'L',
                'description' => 'Standard unit of volume',
                'status' => 1
            ],
            [
                'name' => 'Bottle',
                'abbreviation' => 'Btl',
                'description' => 'Standard bottle quantity',
                'status' => 1
            ],
            [
                'name' => 'Box',
                'abbreviation' => 'Box',
                'description' => 'Standard box quantity',
                'status' => 1
            ],
            [
                'name' => 'Dozen',
                'abbreviation' => 'Dz',
                'description' => 'Set of twelve units',
                'status' => 1
            ],
            [
                'name' => 'Milliliter',
                'abbreviation' => 'ml',
                'description' => '1/1000 of a litre',
                'status' => 1
            ],
            [
                'name' => 'Pack',
                'abbreviation' => 'Pack',
                'description' => 'Standard pack quantity',
                'status' => 1
            ]
        ];

        foreach ($units as $unit) {
            ProductUnit::create($unit);
        }
    }
}