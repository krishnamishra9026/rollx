<?php

namespace Database\Seeders;

use App\Models\InventoryEquipment;
use App\Models\InventoryEquipmentPart;
use App\Models\InventoryEquipmentSerialNo;
use App\Models\Part;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $equipment_1 = InventoryEquipment::create([
            'equipment_name'    => "Chiller",
            'date_added'        => Carbon::now()->format("Y-m-d"),
            'remark'            => "This remark field is for Chiller",
        ]);
        $equipment_1_part_ids       = [388, 367, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386];

        foreach ($equipment_1_part_ids as $key => $equipment_1_part_id) {
            InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $equipment_1->id,
                'part_id'                   => $equipment_1_part_id,
                'quantity'                  => 1,
            ]);
        }
        for ($j = 1; $j < 11; $j++) {
            InventoryEquipmentSerialNo::create([
                'inventory_equipment_id'    => $equipment_1->id,
                'serial_no'                 => "SHLIESN" . $equipment_1->id . '0000' . $j
            ]);
        }

        $equipment_2 = InventoryEquipment::create([
            'equipment_name'    => "Heat Exchanger Systems",
            'date_added'        => Carbon::now()->format("Y-m-d"),
            'remark'            => "This remark field is for Heat Exchanger Systems",
        ]);
        $equipment_2_part_ids       =  [388, 389];

        foreach ($equipment_2_part_ids as $key => $equipment_2_part_id) {
            InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $equipment_2->id,
                'part_id'                   => $equipment_2_part_id,
                'quantity'                  => 1,
            ]);
        }
        for ($k = 1; $k < 11; $k++) {
            InventoryEquipmentSerialNo::create([
                'inventory_equipment_id'    => $equipment_2->id,
                'serial_no'                 => "SHLIESN" . $equipment_2->id . '0000' . $k
            ]);
        }

        $equipment_3 = InventoryEquipment::create([
            'equipment_name'    => "Old/Rental Chiller",
            'date_added'        => Carbon::now()->format("Y-m-d"),
            'remark'            => "This remark field is for Old/Rental Chiller",
        ]);
        $equipment_3_part_ids       =  [390];

        foreach ($equipment_3_part_ids as $key => $equipment_3_part_id) {
            InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $equipment_3->id,
                'part_id'                   => $equipment_3_part_id,
                'quantity'                  => 1,
            ]);
        }
        for ($l = 1; $l < 11; $l++) {
            InventoryEquipmentSerialNo::create([
                'inventory_equipment_id'    => $equipment_3->id,
                'serial_no'                 => "SHLIESN" . $equipment_3->id . '0000' . $l
            ]);
        }

        $equipment_4 = InventoryEquipment::create([
            'equipment_name'    => "Heat Pumps",
            'date_added'        => Carbon::now()->format("Y-m-d"),
            'remark'            => "This remark field is for Heat Pumps",
        ]);
        $equipment_4_part_ids       =  [391];

        foreach ($equipment_4_part_ids as $key => $equipment_4_part_id) {
            InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $equipment_4->id,
                'part_id'                   => $equipment_4_part_id,
                'quantity'                  => 1,
            ]);
        }
        for ($m = 1; $m < 11; $m++) {
            InventoryEquipmentSerialNo::create([
                'inventory_equipment_id'    => $equipment_4->id,
                'serial_no'                 => "SHLIESN" . $equipment_4->id . '0000' . $m
            ]);
        }
        $equipment_5 = InventoryEquipment::create([
            'equipment_name'    => "Heat Recovery Units",
            'date_added'        => Carbon::now()->format("Y-m-d"),
            'remark'            => "This remark field is for Heat Recovery Units",
        ]);
        $equipment_5_part_ids       =  [392];

        foreach ($equipment_5_part_ids as $key => $equipment_5_part_id) {
            InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $equipment_5->id,
                'part_id'                   => $equipment_5_part_id,
                'quantity'                  => 1,
            ]);
        }
        for ($n = 1; $n < 11; $n++) {
            InventoryEquipmentSerialNo::create([
                'inventory_equipment_id'    => $equipment_5->id,
                'serial_no'                 => "SHLIESN" . $equipment_5->id . '0000' . $n
            ]);
        }
    }
}
