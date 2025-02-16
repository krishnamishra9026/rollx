<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Main Components

        Category::create(['id' => 1, 'category_id' => null, 'category'    => 'Main Components', 'type' => 'main-category']);


        // Main Components > Water Pumps

        Category::create(['id' => 2, 'category_id' => 1, 'category'       => 'Water Pumps', 'type' => 'category']);

        Category::create(['id' => 3, 'category_id' => 2, 'category'       => 'CHLF Series']);

        Category::create(['id' => 4, 'category_id' => 2, 'category'       => 'CHM Series']);

        Category::create(['id' => 5, 'category_id' => 2, 'category'       => 'CDL Series']);

        Category::create(['id' => 6, 'category_id' => 2, 'category'       => 'TD Series']);

        Category::create(['id' => 7, 'category_id' => 2, 'category'       => 'ZS Series']);

        Category::create(['id' => 8, 'category_id' => 2, 'category'       => 'Grundfos']);

        Category::create(['id' => 9, 'category_id' => 2, 'category'       => 'SJ Series']);

        Category::create(['id' => 10, 'category_id' => 2, 'category'       => 'Leo']);

        Category::create(['id' => 11, 'category_id' => 2, 'category'       => 'Taobao']);

        Category::create(['id' => 12, 'category_id' => 2, 'category'       => 'Calpeda']);

        Category::create(['id' => 13, 'category_id' => 2, 'category'       => 'Others']);

        // Main Components > Compressors

        Category::create(['id' => 14, 'category_id' => 1, 'category'       => 'Compressors', 'type' => 'category']);

        Category::create(['id' => 15, 'category_id' => 14, 'category'      => 'Shelton DC Inverter']);

        Category::create(['id' => 16, 'category_id' => 14, 'category'      => 'Fixed Speed']);

        Category::create(['id' => 17, 'category_id' => 14, 'category'      => 'Copeland']);

        Category::create(['id' => 18, 'category_id' => 14, 'category'      => 'Dorin']);

        Category::create(['id' => 19, 'category_id' => 14, 'category'      => 'Panasonic']);

        Category::create(['id' => 20, 'category_id' => 14, 'category'      => 'Danfoss DC Inverter']);

        Category::create(['id' => 21, 'category_id' => 14, 'category'      => 'Others']);


        // Main Components > Electronic Expansion Valves

        Category::create(['id' => 22, 'category_id' => 1, 'category'       => 'Electronic Expansion Valves', 'type' => 'category']);

        Category::create(['id' => 23, 'category_id' => 22, 'category'       => 'Danfoss']);

        Category::create(['id' => 24, 'category_id' => 22, 'category'       => 'Carel (Standard use)']);

        Category::create(['id' => 25, 'category_id' => 22, 'category'       => 'Carel (Odd)']);

        // Main Components > Variable Speed Drives

        Category::create(['id' => 26, 'category_id' => 1, 'category'       => 'Variable Speed Drives', 'type' => 'category']);

        Category::create(['id' => 27, 'category_id' => 26, 'category'       => 'Fuji']);

        Category::create(['id' => 28, 'category_id' => 26, 'category'       => 'Mitsubishi']);

        Category::create(['id' => 29, 'category_id' => 26, 'category'       => 'Delta']);

        Category::create(['id' => 30, 'category_id' => 26, 'category'       => 'Carel']);

        Category::create(['id' => 31, 'category_id' => 26, 'category'       => 'Danfoss']);

        // Main Components > Heat Exchanger

        Category::create(['id' => 32, 'category_id' => 1, 'category'   => 'Heat Exchanger', 'type' => 'category']);

        Category::create(['id' => 33, 'category_id' => 32, 'category'   => 'R407C HX']);

        Category::create(['id' => 34, 'category_id' => 32, 'category'   => 'R410A HX']);

        Category::create(['id' => 35, 'category_id' => 32, 'category'   => 'Condenser HX']);

        Category::create(['id' => 36, 'category_id' => 32, 'category'   => 'Water to Water HX']);

        Category::create(['id' => 37, 'category_id' => 32, 'category'   => 'Old/Used HX']);

        Category::create(['id' => 38, 'category_id' => 32, 'category'   => 'Square Type HX']);

        Category::create(['id' => 39, 'category_id' => 32, 'category'   => 'Odd Models']);

        Category::create(['id' => 40, 'category_id' => 32, 'category'   => 'Stainless Steel HX']);

        // Main Components > Condenser

        Category::create(['id' => 41, 'category_id' => 1, 'category'   => 'Condenser', 'type' => 'category']);

        Category::create(['id' => 42, 'category_id' => 41, 'category'   => 'Remote Condensers']);

        Category::create(['id' => 43, 'category_id' => 41, 'category'   => 'Condensing Coil']);

        Category::create(['id' => 44, 'category_id' => 41, 'category'   => 'Condensing Fan']);

        // Built Equipments

        Category::create(['id' => 45, 'category_id' => null, 'category' => 'Built Equipments', 'type' => 'main-category']);

        Category::create(['id' => 46, 'category_id' => 45, 'category'   => 'Chiller', 'type' => 'category']);

        Category::create(['id' => 47, 'category_id' => 46, 'category'   => 'Chiller']);

        Category::create(['id' => 48, 'category_id' => 46, 'category'   => 'Heat Exchanger Systems', 'type' => 'category']);

        Category::create(['id' => 49, 'category_id' => 48, 'category'   => 'Heat Exchanger Systems']);

        Category::create(['id' => 50, 'category_id' => 46, 'category'   => 'Old/Rental Chiller', 'type' => 'category']);

        Category::create(['id' => 51, 'category_id' => 50, 'category'   => 'Old/Rental Chiller']);

        Category::create(['id' => 52, 'category_id' => 46, 'category'   => 'Heat Pumps', 'type' => 'category']);

        Category::create(['id' => 53, 'category_id' => 52, 'category'   => 'Heat Pumps']);

        Category::create(['id' => 54, 'category_id' => 46, 'category'   => 'Heat Recovery Units', 'type' => 'category']);

        Category::create(['id' => 55, 'category_id' => 54, 'category'   => 'Heat Recovery Units']);

        // Accessories

        Category::create(['id' => 56, 'category_id' => null, 'category'    => 'Accessories', 'type' => 'main-category']);

        Category::create(['id' => 57, 'category_id' => 56, 'category'    => 'Motorize Valves', 'type' => 'category']);

        Category::create(['id' => 58, 'category_id' => 57, 'category'    => 'Regin']);


        Category::create(['id' => 59, 'category_id' => 57, 'category'    => 'Danfoss']);


        Category::create(['id' => 60, 'category_id' => 56, 'category'    => 'Water Tanks', 'type' => 'category']);

        Category::create(['id' => 61, 'category_id' => 60, 'category'    => 'Round Tank']);

        Category::create(['id' => 62, 'category_id' => 60, 'category'    => 'Makeup Tank']);

        Category::create(['id' => 63, 'category_id' => 60, 'category'    => 'Piggyback Tank']);

        Category::create(['id' => 64, 'category_id' => 60, 'category'    => 'Square Tank']);

        Category::create(['id' => 65, 'category_id' => 14, 'category'    => 'Shelton AC Inverter']);

         // Accessories

         Category::create(['id' => 66, 'category_id' => null, 'category'    => 'Built Equipment', 'type' => 'main-category']);

         Category::create(['id' => 67, 'category_id' => 66, 'category'    => 'Chiller', 'type' => 'category']);

         Category::create(['id' => 68, 'category_id' => 67, 'category'    => 'Chiller']);

         Category::create(['id' => 69, 'category_id' => 66, 'category'    => 'Heat Exchanger Systems', 'type' => 'category']);

         Category::create(['id' => 70, 'category_id' => 69, 'category'    => 'Heat Exchanger Systems']);

         Category::create(['id' => 71, 'category_id' => 66, 'category'    => 'Old/Rental Chiller', 'type' => 'category']);

         Category::create(['id' => 72, 'category_id' => 71, 'category'    => 'Old/Rental Chiller']);

         Category::create(['id' => 73, 'category_id' => 66, 'category'    => 'Heat Pumps', 'type' => 'category']);

         Category::create(['id' => 74, 'category_id' => 73, 'category'    => 'Heat Pumps']);

         Category::create(['id' => 75, 'category_id' => 66, 'category'    => 'Heat Recovery Units', 'type' => 'category']);

         Category::create(['id' => 76, 'category_id' => 75, 'category'    => 'Heat Recovery Units']);
    }
}
