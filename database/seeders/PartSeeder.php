<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Part;
use App\Models\PartSerialNo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Part::create([
            'id' => 1,
            'category_id' => 3,
            'part' => 'CHLF 0220  1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0001',
            'serial_number' => 'SHLPSN0001',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 2,
            'category_id' => 3,
            'part' => 'CHLF 0230  1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0002',
            'serial_number' => 'SHLPSN0002',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 3,
            'category_id' => 3,
            'part' => 'CHLF 0240  1PH',
            'refrence' => 'AC1, AC2 Standard Pump',
            'model_number' => 'SHLPMN0003',
            'serial_number' => 'SHLPSN0003',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 4,
            'category_id' => 3,
            'part' => 'CHLF 0250  1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0004',
            'serial_number' => 'SHLPSN0004',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 5,
            'category_id' => 3,
            'part' => 'CHLF 0260  1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0005',
            'serial_number' => 'SHLPSN0005',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 6,
            'category_id' => 3,
            'part' => 'CHLF 0460  1PH',
            'refrence' => 'Special!! For HX Systems',
            'model_number' => 'SHLPMN0006',
            'serial_number' => 'SHLPSN0006',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 7,
            'category_id' => 3,
            'part' => 'CHLF 0240  3PH',
            'refrence' => 'AC3 Standard Pump',
            'model_number' => 'SHLPMN0007',
            'serial_number' => 'SHLPSN0007',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 8,
            'category_id' => 3,
            'part' => 'CHLF 0250  3PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0008',
            'serial_number' => 'SHLPSN0008',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 9,
            'category_id' => 3,
            'part' => 'CHLF 0260  3PH',
            'refrence' => 'AC5 Standard Pump',
            'model_number' => 'SHLPMN0009',
            'serial_number' => 'SHLPSN0009',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 10,
            'category_id' => 3,
            'part' => 'CHLF 0420',
            'refrence' => null,
            'model_number' => 'SHLPMN0010',
            'serial_number' => 'SHLPSN0010',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 11,
            'category_id' => 3,
            'part' => 'CHLF 0430',
            'refrence' => null,
            'model_number' => 'SHLPMN0011',
            'serial_number' => 'SHLPSN0011',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 12,
            'category_id' => 3,
            'part' => 'CHLF 0440',
            'refrence' => 'AC8 Standard Pump',
            'model_number' => 'SHLPMN0012',
            'serial_number' => 'SHLPSN0012',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 13,
            'category_id' => 3,
            'part' => 'CHLF 0460',
            'refrence' => 'IDAC10 Standard Pump',
            'model_number' => 'SHLPMN0013',
            'serial_number' => 'SHLPSN0013',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 14,
            'category_id' => 3,
            'part' => 'CHLF 0820',
            'refrence' => null,
            'model_number' => 'SHLPMN0014',
            'serial_number' => 'SHLPSN0014',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 15,
            'category_id' => 3,
            'part' => 'CHLF 0830',
            'refrence' => 'to be phased out. Replaced by CHL12-20 or Equivalent',
            'model_number' => 'SHLPMN0015',
            'serial_number' => 'SHLPSN0015',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 16,
            'category_id' => 3,
            'part' => 'CHLF 0850',
            'refrence' => 'IDAC15 / IDAC20 Standard Pump',
            'model_number' => 'SHLPMN0016',
            'serial_number' => 'SHLPSN0016',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 17,
            'category_id' => 3,
            'part' => 'CHLF 1210',
            'refrence' => null,
            'model_number' => 'SHLPMN0017',
            'serial_number' => 'SHLPSN0017',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 18,
            'category_id' => 3,
            'part' => 'CHLF 1220',
            'refrence' => null,
            'model_number' => 'SHLPMN0018',
            'serial_number' => 'SHLPSN0018',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 19,
            'category_id' => 3,
            'part' => 'CHLF 1250',
            'refrence' => 'IMAC25 / IDAC30 Standard Pump',
            'model_number' => 'SHLPMN0019',
            'serial_number' => 'SHLPSN0019',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 20,
            'category_id' => 3,
            'part' => 'CHLF 1610',
            'refrence' => null,
            'model_number' => 'SHLPMN0020',
            'serial_number' => 'SHLPSN0020',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 21,
            'category_id' => 3,
            'part' => 'CHLF 1620',
            'refrence' => null,
            'model_number' => 'SHLPMN0021',
            'serial_number' => 'SHLPSN0021',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 22,
            'category_id' => 3,
            'part' => 'CHLF 1640',
            'refrence' => 'IDAC40 Standard Pump',
            'model_number' => 'SHLPMN0022',
            'serial_number' => 'SHLPSN0022',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 23,
            'category_id' => 3,
            'part' => 'CHLF 2020',
            'refrence' => null,
            'model_number' => 'SHLPMN0023',
            'serial_number' => 'SHLPSN0023',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 24,
            'category_id' => 3,
            'part' => 'CHLF 2040',
            'refrence' => 'IDAC60 Standard Pump',
            'model_number' => 'SHLPMN0024',
            'serial_number' => 'SHLPSN0024',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 25,
            'category_id' => 4,
            'part' => 'CHM1-2 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0025',
            'serial_number' => 'SHLPSN0025',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 26,
            'category_id' => 4,
            'part' => 'CHM1-3 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0026',
            'serial_number' => 'SHLPSN0026',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 27,
            'category_id' => 4,
            'part' => 'CHM1-4 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0027',
            'serial_number' => 'SHLPSN0027',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 28,
            'category_id' => 4,
            'part' => 'CHM1-5 1PH',
            'refrence' => 'AC1, AC2 Standard Pump',
            'model_number' => 'SHLPMN0028',
            'serial_number' => 'SHLPSN0028',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 29,
            'category_id' => 4,
            'part' => 'CHM1-6 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0029',
            'serial_number' => 'SHLPSN0029',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 30,
            'category_id' => 4,
            'part' => 'CHM2-2 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0030',
            'serial_number' => 'SHLPSN0030',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 31,
            'category_id' => 4,
            'part' => 'CHM2-3 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0031',
            'serial_number' => 'SHLPSN0031',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 32,
            'category_id' => 4,
            'part' => 'CHM2-4 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0032',
            'serial_number' => 'SHLPSN0032',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 33,
            'category_id' => 4,
            'part' => 'CHM2-5 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0033',
            'serial_number' => 'SHLPSN0033',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 34,
            'category_id' => 4,
            'part' => 'CHM2-6 1PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0034',
            'serial_number' => 'SHLPSN0034',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 35,
            'category_id' => 4,
            'part' => 'CHM2-2 3PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0035',
            'serial_number' => 'SHLPSN0035',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 36,
            'category_id' => 4,
            'part' => 'CHM2-3 3PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0036',
            'serial_number' => 'SHLPSN0036',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 37,
            'category_id' => 4,
            'part' => 'CHM2-4 3PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0037',
            'serial_number' => 'SHLPSN0037',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 38,
            'category_id' => 4,
            'part' => 'CHM2-5 3PH',
            'refrence' => null,
            'model_number' => 'SHLPMN0038',
            'serial_number' => 'SHLPSN0038',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 39,
            'category_id' => 4,
            'part' => 'CHM2-6 3PH',
            'refrence' => 'AC3,5 Standard Pump',
            'model_number' => 'SHLPMN0039',
            'serial_number' => 'SHLPSN0039',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 40,
            'category_id' => 4,
            'part' => 'CHM4-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0040',
            'serial_number' => 'SHLPSN0040',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 41,
            'category_id' => 4,
            'part' => 'CHM4-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0041',
            'serial_number' => 'SHLPSN0041',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 42,
            'category_id' => 4,
            'part' => 'CHM4-4',
            'refrence' => 'AC8 Standard Pump',
            'model_number' => 'SHLPMN0042',
            'serial_number' => 'SHLPSN0042',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 43,
            'category_id' => 4,
            'part' => 'CHM4-5',
            'refrence' => null,
            'model_number' => 'SHLPMN0043',
            'serial_number' => 'SHLPSN0043',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 44,
            'category_id' => 4,
            'part' => 'CHM4-6',
            'refrence' => 'IDAC10 Standard Pump',
            'model_number' => 'SHLPMN0044',
            'serial_number' => 'SHLPSN0044',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 45,
            'category_id' => 4,
            'part' => 'CHM8-1',
            'refrence' => null,
            'model_number' => 'SHLPMN0045',
            'serial_number' => 'SHLPSN0045',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 46,
            'category_id' => 4,
            'part' => 'CHM8-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0046',
            'serial_number' => 'SHLPSN0046',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 47,
            'category_id' => 4,
            'part' => 'CHM8-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0047',
            'serial_number' => 'SHLPSN0047',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 48,
            'category_id' => 4,
            'part' => 'CHM8-4',
            'refrence' => null,
            'model_number' => 'SHLPMN0048',
            'serial_number' => 'SHLPSN0048',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 49,
            'category_id' => 4,
            'part' => 'CHM8-5',
            'refrence' => 'IDAC15 / IDAC20 Standard Pump',
            'model_number' => 'SHLPMN0049',
            'serial_number' => 'SHLPSN0049',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 50,
            'category_id' => 4,
            'part' => 'CHM12-1',
            'refrence' => null,
            'model_number' => 'SHLPMN0050',
            'serial_number' => 'SHLPSN0050',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 51,
            'category_id' => 4,
            'part' => 'CHM12-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0051',
            'serial_number' => 'SHLPSN0051',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 52,
            'category_id' => 4,
            'part' => 'CHM12-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0052',
            'serial_number' => 'SHLPSN0052',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 53,
            'category_id' => 4,
            'part' => 'CHM12-4',
            'refrence' => null,
            'model_number' => 'SHLPMN0053',
            'serial_number' => 'SHLPSN0053',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 54,
            'category_id' => 4,
            'part' => 'CHM12-5',
            'refrence' => 'IMAC25 / IDAC30 Standard Pump',
            'model_number' => 'SHLPMN0054',
            'serial_number' => 'SHLPSN0054',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 55,
            'category_id' => 4,
            'part' => 'CHM16-1',
            'refrence' => null,
            'model_number' => 'SHLPMN0055',
            'serial_number' => 'SHLPSN0055',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 56,
            'category_id' => 4,
            'part' => 'CHM16-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0056',
            'serial_number' => 'SHLPSN0056',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 57,
            'category_id' => 4,
            'part' => 'CHM16-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0057',
            'serial_number' => 'SHLPSN0057',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 58,
            'category_id' => 4,
            'part' => 'CHM15-4',
            'refrence' => 'IDAC40 Standard Pump / Current Model CHM15-4, no more CHM16-4',
            'model_number' => 'SHLPMN0058',
            'serial_number' => 'SHLPSN0058',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 59,
            'category_id' => 4,
            'part' => 'CHM20-1',
            'refrence' => null,
            'model_number' => 'SHLPMN0059',
            'serial_number' => 'SHLPSN0059',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 60,
            'category_id' => 4,
            'part' => 'CHM20-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0060',
            'serial_number' => 'SHLPSN0060',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 61,
            'category_id' => 4,
            'part' => 'CHM20-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0061',
            'serial_number' => 'SHLPSN0061',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 62,
            'category_id' => 4,
            'part' => 'CHM20-4',
            'refrence' => 'IDAC60 Standard Pump',
            'model_number' => 'SHLPMN0062',
            'serial_number' => 'SHLPSN0062',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 63,
            'category_id' => 5,
            'part' => 'CDL 42-60-2',
            'refrence' => 'Moved to Ubi Store 8/11/2022 22KW',
            'model_number' => 'SHLPMN0063',
            'serial_number' => 'SHLPSN0063',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 64,
            'category_id' => 6,
            'part' => 'TD-40-48-2',
            'refrence' => 'Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0064',
            'serial_number' => 'SHLPSN0064',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 65,
            'category_id' => 6,
            'part' => 'TD-50-50-2',
            'refrence' => 'Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0065',
            'serial_number' => 'SHLPSN0065',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 66,
            'category_id' => 6,
            'part' => 'TD-50-80/2',
            'refrence' => 'Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0066',
            'serial_number' => 'SHLPSN0066',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 67,
            'category_id' => 6,
            'part' => 'TD-50-70G/2',
            'refrence' => 'Moved to Ubi store 7/3/2022',
            'model_number' => 'SHLPMN0067',
            'serial_number' => 'SHLPSN0067',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 68,
            'category_id' => 6,
            'part' => 'TD80-30/2',
            'refrence' => 'Used from HP Chiller MAC80. Moved to Ubi store 10/11/2022',
            'model_number' => 'SHLPMN0068',
            'serial_number' => 'SHLPSN0068',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 69,
            'category_id' => 6,
            'part' => 'TD-125-22-4',
            'refrence' => 'Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0069',
            'serial_number' => 'SHLPSN0069',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 70,
            'category_id' => 7,
            'part' => 'ZS-65-40-200-5.5',
            'refrence' => 'Tested and moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0070',
            'serial_number' => 'SHLPSN0070',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 71,
            'category_id' => 7,
            'part' => 'ZS-65-50-125/3.0 ',
            'refrence' => 'Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0071',
            'serial_number' => 'SHLPSN0071',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 72,
            'category_id' => 7,
            'part' => 'ZS65-40-200/11',
            'refrence' => '11KW from DSO AC20, Moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0072',
            'serial_number' => 'SHLPSN0072',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 73,
            'category_id' => 7,
            'part' => 'ZS-65-50-200/9.2',
            'refrence' => 'Tested and moved to Ubi store 7/3/2022, Used',
            'model_number' => 'SHLPMN0073',
            'serial_number' => 'SHLPSN0073',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 74,
            'category_id' => 7,
            'part' => 'ZS-65-40-200/7.5 ',
            'refrence' => 'Moved to Ubi store 7/3/2022. 1 x Used, 2 x New',
            'model_number' => 'SHLPMN0074',
            'serial_number' => 'SHLPSN0074',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 75,
            'category_id' => 7,
            'part' => 'ZS-80-65-125/9.2',
            'refrence' => 'Tested and moved to Ubi store 7/3/2022. New',
            'model_number' => 'SHLPMN0075',
            'serial_number' => 'SHLPSN0075',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 76,
            'category_id' => 8,
            'part' => 'Grundfos CM 1-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0076',
            'serial_number' => 'SHLPSN0076',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 77,
            'category_id' => 8,
            'part' => 'Grundfos CM 3-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0077',
            'serial_number' => 'SHLPSN0077',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 78,
            'category_id' => 8,
            'part' => 'Grundfos CM 5-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0078',
            'serial_number' => 'SHLPSN0078',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 79,
            'category_id' => 8,
            'part' => 'Grundfos CM 5-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0079',
            'serial_number' => 'SHLPSN0079',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 80,
            'category_id' => 8,
            'part' => 'Grundfos CM 10-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0080',
            'serial_number' => 'SHLPSN0080',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 81,
            'category_id' => 8,
            'part' => 'Grundfos CM 15-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0081',
            'serial_number' => 'SHLPSN0081',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 82,
            'category_id' => 8,
            'part' => 'Grundfos CM 25-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0082',
            'serial_number' => 'SHLPSN0082',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 83,
            'category_id' => 9,
            'part' => 'SJ12-5SWSF4Y',
            'refrence' => 'Moved to Ubi store 7/3/2022',
            'model_number' => 'SHLPMN0083',
            'serial_number' => 'SHLPSN0083',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 84,
            'category_id' => 9,
            'part' => 'SJ17-9SLSP6Y',
            'refrence' => 'Moved to Ubi store 7/3/2022',
            'model_number' => 'SHLPMN0084',
            'serial_number' => 'SHLPSN0084',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 85,
            'category_id' => 9,
            'part' => 'SJ3-9DWSF4',
            'refrence' => 'Sump pump. Dismantled from Setsco. Single Phase. Need to add 25uF capacitor.',
            'model_number' => 'SHLPMN0085',
            'serial_number' => 'SHLPSN0085',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 86,
            'category_id' => 10,
            'part' => 'Leo XQm50',
            'refrence' => null,
            'model_number' => 'SHLPMN0086',
            'serial_number' => 'SHLPSN0086',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 87,
            'category_id' => 10,
            'part' => 'Leo XQm70',
            'refrence' => null,
            'model_number' => 'SHLPMN0087',
            'serial_number' => 'SHLPSN0087',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 88,
            'category_id' => 10,
            'part' => 'Leo XQm80',
            'refrence' => null,
            'model_number' => 'SHLPMN0088',
            'serial_number' => 'SHLPSN0088',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 89,
            'category_id' => 10,
            'part' => 'Leo AP220',
            'refrence' => null,
            'model_number' => 'SHLPMN0089',
            'serial_number' => 'SHLPSN0089',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 90,
            'category_id' => 10,
            'part' => 'Leo APM75',
            'refrence' => null,
            'model_number' => 'SHLPMN0090',
            'serial_number' => 'SHLPSN0090',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 91,
            'category_id' => 10,
            'part' => 'Leo APM150',
            'refrence' => null,
            'model_number' => 'SHLPMN0091',
            'serial_number' => 'SHLPSN0091',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 92,
            'category_id' => 10,
            'part' => 'EMH2-3',
            'refrence' => null,
            'model_number' => 'SHLPMN0092',
            'serial_number' => 'SHLPSN0092',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:26'
        ]);

        Part::create([
            'id' => 93,
            'category_id' => 10,
            'part' => 'EMH8-2',
            'refrence' => null,
            'model_number' => 'SHLPMN0093',
            'serial_number' => 'SHLPSN0093',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:26',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 94,
            'category_id' => 10,
            'part' => 'EMH4-4',
            'refrence' => null,
            'model_number' => 'SHLPMN0094',
            'serial_number' => 'SHLPSN0094',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 95,
            'category_id' => 11,
            'part' => 'Eleware Submersible Pump 750W',
            'refrence' => null,
            'model_number' => 'SHLPMN0095',
            'serial_number' => 'SHLPSN0095',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 96,
            'category_id' => 11,
            'part' => 'QDX1.5-15-0.37',
            'refrence' => null,
            'model_number' => 'SHLPMN0096',
            'serial_number' => 'SHLPSN0096',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 97,
            'category_id' => 11,
            'part' => 'QDX1.5-17-0.37L2',
            'refrence' => null,
            'model_number' => 'SHLPMN0097',
            'serial_number' => 'SHLPSN0097',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 98,
            'category_id' => 12,
            'part' => 'Calpeda CTM61',
            'refrence' => null,
            'model_number' => 'SHLPMN0098',
            'serial_number' => 'SHLPSN0098',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 99,
            'category_id' => 13,
            'part' => 'Salmson Multi-H405',
            'refrence' => null,
            'model_number' => 'SHLPMN0099',
            'serial_number' => 'SHLPSN0099',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 100,
            'category_id' => 10,
            'part' => 'Leo AMS (210) 2.2KW',
            'refrence' => null,
            'model_number' => 'SHLPMN0100',
            'serial_number' => 'SHLPSN0100',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 101,
            'category_id' => 15,
            'part' => 'SAE-R100',
            'refrence' => 'MNB36FABMC (10HP)(30-360Hz)',
            'model_number' => 'SHLPMN0101',
            'serial_number' => 'SHLPSN0101',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 102,
            'category_id' => 15,
            'part' => 'SAE-R120',
            'refrence' => 'LNB53FCAMC  (12HP)',
            'model_number' => 'SHLPMN0102',
            'serial_number' => 'SHLPSN0102',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 103,
            'category_id' => 15,
            'part' => 'SAE-R150',
            'refrence' => 'LNB65FAEMC (15HP)(30-360Hz)',
            'model_number' => 'SHLPMN0103',
            'serial_number' => 'SHLPSN0103',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 104,
            'category_id' => 15,
            'part' => 'SAE-R030',
            'refrence' => 'SNB140FUYMC (3HP)',
            'model_number' => 'SHLPMN0104',
            'serial_number' => 'SHLPSN0104',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 105,
            'category_id' => 15,
            'part' => 'SAE-S200',
            'refrence' => 'ANB87 (20HP)(45-360Hz)',
            'model_number' => 'SHLPMN0105',
            'serial_number' => 'SHLPSN0105',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 106,
            'category_id' => 15,
            'part' => 'SAE-RH100',
            'refrence' => 'WHP15600ASDPC9EQ (10HP)(30-240Hz)',
            'model_number' => 'SHLPMN0106',
            'serial_number' => 'SHLPSN0106',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 107,
            'category_id' => 15,
            'part' => 'SAE-SSH150',
            'refrence' => 'ATE650SKTQ9JKP (15HP)(45-330Hz)',
            'model_number' => 'SHLPMN0107',
            'serial_number' => 'SHLPSN0107',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 108,
            'category_id' => 15,
            'part' => 'SAE-SSH200',
            'refrence' => 'ATE848SKTQ9JK (20HP)(45-330Hz)',
            'model_number' => 'SHLPMN0108',
            'serial_number' => 'SHLPSN0108',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 109,
            'category_id' => 65,
            'part' => 'SAE-IS-300',
            'refrence' => null,
            'model_number' => 'SHLPMN0109',
            'serial_number' => 'SHLPSN0109',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 110,
            'category_id' => 65,
            'part' => 'SAE-IS-350',
            'refrence' => null,
            'model_number' => 'SHLPMN0110',
            'serial_number' => 'SHLPSN0110',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 111,
            'category_id' => 65,
            'part' => 'SAE-IS-500',
            'refrence' => null,
            'model_number' => 'SHLPMN0111',
            'serial_number' => 'SHLPSN0111',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 112,
            'category_id' => 65,
            'part' => 'SAE-IS-500 (G)',
            'refrence' => 'Going to phase out',
            'model_number' => 'SHLPMN0112',
            'serial_number' => 'SHLPSN0112',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 113,
            'category_id' => 65,
            'part' => 'SAE-IS-500-T (G)',
            'refrence' => 'Can use to replace IS500G - Jessica 5/5/22, can use for IS500T Julia 4/1/23',
            'model_number' => 'SHLPMN0113',
            'serial_number' => 'SHLPSN0113',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 114,
            'category_id' => 16,
            'part' => '1 HP (R410A)',
            'refrence' => '5PS108EAA22',
            'model_number' => 'SHLPMN0114',
            'serial_number' => 'SHLPSN0114',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 115,
            'category_id' => 16,
            'part' => '2 HP (R410A)',
            'refrence' => '5KS225EAA21',
            'model_number' => 'SHLPMN0115',
            'serial_number' => 'SHLPSN0115',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 116,
            'category_id' => 16,
            'part' => '3 HP (R410A) (3 PH)',
            'refrence' => '3 PH - ATQ375Y1UMU',
            'model_number' => 'SHLPMN0116',
            'serial_number' => 'SHLPSN0116',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 117,
            'category_id' => 16,
            'part' => '3 HP (R410A) (Single Phase)',
            'refrence' => '1 PH - LN32VBRMC',
            'model_number' => 'SHLPMN0117',
            'serial_number' => 'SHLPSN0117',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 118,
            'category_id' => 16,
            'part' => '5 HP (R410A)',
            'refrence' => 'ATW590Y1UNK',
            'model_number' => 'SHLPMN0118',
            'serial_number' => 'SHLPSN0118',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 119,
            'category_id' => 16,
            'part' => '1 HP (R407C)',
            'refrence' => 'Panasonic 2P17S225ANQ',
            'model_number' => 'SHLPMN0119',
            'serial_number' => 'SHLPSN0119',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 120,
            'category_id' => 16,
            'part' => '2 HP (R407C)',
            'refrence' => 'Panasonic 2V36S225AUA',
            'model_number' => 'SHLPMN0120',
            'serial_number' => 'SHLPSN0120',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 121,
            'category_id' => 16,
            'part' => '3 HP (R407C)',
            'refrence' => 'Panasonic 2V47W225AUA, 1 Used ** NON-STANDARD.\nThis is Single Phase. Our standard is Three Phase.',
            'model_number' => 'SHLPMN0121',
            'serial_number' => 'SHLPSN0121',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 122,
            'category_id' => 16,
            'part' => 'SAE-FS-500-G',
            'refrence' => 'Going to phase out',
            'model_number' => 'SHLPMN0122',
            'serial_number' => 'SHLPSN0122',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 123,
            'category_id' => 16,
            'part' => 'SAE-FS-500-T',
            'refrence' => null,
            'model_number' => 'SHLPMN0123',
            'serial_number' => 'SHLPSN0123',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 124,
            'category_id' => 16,
            'part' => 'SAE-FS-500-T (G)',
            'refrence' => 'Can use to replace FS500G - Jessica 5/5/22',
            'model_number' => 'SHLPMN0124',
            'serial_number' => 'SHLPSN0124',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 125,
            'category_id' => 16,
            'part' => '2V42S225AUA',
            'refrence' => 'Panasonic 2.5HP, for WF WC3 Series',
            'model_number' => 'SHLPMN0125',
            'serial_number' => 'SHLPSN0125',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 126,
            'category_id' => 16,
            'part' => '2V47W385AUA',
            'refrence' => '3-Phase',
            'model_number' => 'SHLPMN0126',
            'serial_number' => 'SHLPSN0126',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 127,
            'category_id' => 17,
            'part' => 'ZR61KCTFD522',
            'refrence' => '5HP',
            'model_number' => 'SHLPMN0127',
            'serial_number' => 'SHLPSN0127',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 128,
            'category_id' => 17,
            'part' => 'VR125KS-TFP-522',
            'refrence' => '10HP ',
            'model_number' => 'SHLPMN0128',
            'serial_number' => 'SHLPSN0128',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 129,
            'category_id' => 17,
            'part' => 'VR144KS-TFP-522',
            'refrence' => '12HP',
            'model_number' => 'SHLPMN0129',
            'serial_number' => 'SHLPSN0129',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 130,
            'category_id' => 17,
            'part' => 'ZR160KC-TFD-522',
            'refrence' => '13.5HP',
            'model_number' => 'SHLPMN0130',
            'serial_number' => 'SHLPSN0130',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 131,
            'category_id' => 17,
            'part' => 'ZR190KC-TFD-522',
            'refrence' => '15HP',
            'model_number' => 'SHLPMN0131',
            'serial_number' => 'SHLPSN0131',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 132,
            'category_id' => 18,
            'part' => 'Dorin HI 361CC',
            'refrence' => 'Moved to Ubi Store 7/3/2022',
            'model_number' => 'SHLPMN0132',
            'serial_number' => 'SHLPSN0132',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 133,
            'category_id' => 18,
            'part' => 'Dorin HI 551CC',
            'refrence' => 'KKH Use. Moved to Ubi Store on 7/3/2022 and 2/4/2022',
            'model_number' => 'SHLPMN0133',
            'serial_number' => 'SHLPSN0133',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 134,
            'category_id' => 18,
            'part' => 'Dorin HI751CC',
            'refrence' => 'Moved to Ubi Store 2/4/2022',
            'model_number' => 'SHLPMN0134',
            'serial_number' => 'SHLPSN0134',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 135,
            'category_id' => 18,
            'part' => 'Dorin HI1501CC',
            'refrence' => 'Moved to Ubi Store 7/3/2022',
            'model_number' => 'SHLPMN0135',
            'serial_number' => 'SHLPSN0135',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 136,
            'category_id' => 18,
            'part' => 'Dorin H1500CC',
            'refrence' => '15HP, Moved to Ubi Store 7/3/2022',
            'model_number' => 'SHLPMN0136',
            'serial_number' => 'SHLPSN0136',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 137,
            'category_id' => 18,
            'part' => 'Dorin H1000CC',
            'refrence' => 'Moved to Ubi Store 11/3/2022',
            'model_number' => 'SHLPMN0137',
            'serial_number' => 'SHLPSN0137',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 138,
            'category_id' => 19,
            'part' => 'Panasonic C-SCN903H8H',
            'refrence' => '12HP Compressor 50HZ',
            'model_number' => 'SHLPMN0138',
            'serial_number' => 'SHLPSN0138',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 139,
            'category_id' => 21,
            'part' => 'Panasonic C-SCN753H8H ',
            'refrence' => '10HP Compressor 50HZ',
            'model_number' => 'SHLPMN0139',
            'serial_number' => 'SHLPSN0139',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 140,
            'category_id' => 21,
            'part' => 'Sanyo SB303H5A',
            'refrence' => null,
            'model_number' => 'SHLPMN0140',
            'serial_number' => 'SHLPSN0140',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 141,
            'category_id' => 16,
            'part' => 'SAE-FS-095',
            'refrence' => null,
            'model_number' => 'SHLPMN0141',
            'serial_number' => 'SHLPSN0141',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 142,
            'category_id' => 16,
            'part' => 'SAE-FS-160',
            'refrence' => null,
            'model_number' => 'SHLPMN0142',
            'serial_number' => 'SHLPSN0142',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 143,
            'category_id' => 16,
            'part' => 'WHP11270GUV-C9EU',
            'refrence' => '5HP R32/R410A Gas single phase',
            'model_number' => 'SHLPMN0143',
            'serial_number' => 'SHLPSN0143',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 144,
            'category_id' => 15,
            'part' => 'WHP15600ASDPC9EQ',
            'refrence' => 'Dismantle from DSO SQ16V2 IDAC8',
            'model_number' => 'SHLPMN0144',
            'serial_number' => 'SHLPSN0144',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 145,
            'category_id' => 16,
            'part' => 'ZB58KQE-TFD-550 (R134A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0145',
            'serial_number' => 'SHLPSN0145',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 146,
            'category_id' => 21,
            'part' => 'ZB114K0E',
            'refrence' => ' Second hand. Pactera labelling on it.',
            'model_number' => 'SHLPMN0146',
            'serial_number' => 'SHLPSN0146',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 147,
            'category_id' => 21,
            'part' => 'ZR144KC-TFD-522',
            'refrence' => ' Second hand. ',
            'model_number' => 'SHLPMN0147',
            'serial_number' => 'SHLPSN0147',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 148,
            'category_id' => 21,
            'part' => 'MTZ56HL4AVE',
            'refrence' => ' Second hand. ',
            'model_number' => 'SHLPMN0148',
            'serial_number' => 'SHLPSN0148',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 149,
            'category_id' => 21,
            'part' => 'H4500CC',
            'refrence' => 'Used from Probiz MAC80',
            'model_number' => 'SHLPMN0149',
            'serial_number' => 'SHLPSN0149',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 150,
            'category_id' => 21,
            'part' => 'Tecumseh CAJ9480T (R22)',
            'refrence' => '2nd Hand Unit, took back from KSC',
            'model_number' => 'SHLPMN0150',
            'serial_number' => 'SHLPSN0150',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 151,
            'category_id' => 20,
            'part' => 'VZH170CGANA (Norm)',
            'refrence' => 'Comp + CDS303P22KT4E20H2 (Ubi Store)',
            'model_number' => 'SHLPMN0151',
            'serial_number' => 'SHLPSN0151',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 152,
            'category_id' => 20,
            'part' => 'VZH170CGAMA (Norm)',
            'refrence' => 'Comp (NEW model) + Drive CDS803P30KT4E20H2',
            'model_number' => 'SHLPMN0152',
            'serial_number' => 'SHLPSN0152',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 153,
            'category_id' => 20,
            'part' => 'VZH117CGANA/I/P06 (Norm)',
            'refrence' => 'Comp + Drive CDS803P22KT4E20H2',
            'model_number' => 'SHLPMN0153',
            'serial_number' => 'SHLPSN0153',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 154,
            'category_id' => 20,
            'part' => 'VZH088CGDNA/I/P06 (Norm)',
            'refrence' => 'Comp + Drive CDS303P15KT4E20H2',
            'model_number' => 'SHLPMN0154',
            'serial_number' => 'SHLPSN0154',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 155,
            'category_id' => 20,
            'part' => 'VTZ086',
            'refrence' => '8HP R134A + Drive CD302PK5T4E',
            'model_number' => 'SHLPMN0155',
            'serial_number' => 'SHLPSN0155',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 156,
            'category_id' => 20,
            'part' => '',
            'refrence' => null,
            'model_number' => 'SHLPMN0156',
            'serial_number' => 'SHLPSN0156',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 157,
            'category_id' => 20,
            'part' => 'VZH170CGDNA (OLS)',
            'refrence' => 'Comp OLS + CDS803P30KT4E20H2 (Ubi Store-26/5/23)',
            'model_number' => 'SHLPMN0157',
            'serial_number' => 'SHLPSN0157',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 158,
            'category_id' => 20,
            'part' => 'VZH170CGDMA (OLS)',
            'refrence' => 'Comp OLS (NEW model) + CDS803P30KT4E20H2',
            'model_number' => 'SHLPMN0158',
            'serial_number' => 'SHLPSN0158',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 159,
            'category_id' => 20,
            'part' => 'VZH117CGDNA/I/06 (OLS)',
            'refrence' => 'Comp OLS + Drive CDS803P22KT4E20H2',
            'model_number' => 'SHLPMN0159',
            'serial_number' => 'SHLPSN0159',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 160,
            'category_id' => 20,
            'part' => 'VZH088CGDNA/I/P06 (OLS)',
            'refrence' => 'Comp OLS + Drive CDS803P18KT4E20H2',
            'model_number' => 'SHLPMN0160',
            'serial_number' => 'SHLPSN0160',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 161,
            'category_id' => 20,
            'part' => 'VZH088CGDMA (OLS)',
            'refrence' => 'Comp OLS (NEW model) + Drive CDS803P18KT4E20H2',
            'model_number' => 'SHLPMN0161',
            'serial_number' => 'SHLPSN0161',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 162,
            'category_id' => 20,
            'part' => 'VZH065CGDNB/M (OLS)',
            'refrence' => 'Comp OLS + Drive CDS303P15KT4E20H2',
            'model_number' => 'SHLPMN0162',
            'serial_number' => 'SHLPSN0162',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 163,
            'category_id' => 20,
            'part' => 'VZH052CGDNB/M (OLS)',
            'refrence' => 'Comp OLS + Drive CDS303P11KT4E20H2 (Ubi Store)\nNot to order anymore to keep stock',
            'model_number' => 'SHLPMN0163',
            'serial_number' => 'SHLPSN0163',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 164,
            'category_id' => 20,
            'part' => 'VZH044CGBNB (OLS)',
            'refrence' => 'Comp OLS + Drive CDS803P10KT4E20H4',
            'model_number' => 'SHLPMN0164',
            'serial_number' => 'SHLPSN0164',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 165,
            'category_id' => 20,
            'part' => 'VZH035CGBNB (OLS)',
            'refrence' => 'Comp OLS + Drive CDS803P7K5T4E20H4 (Ubi Store)\nNot to order anymore to keep stock',
            'model_number' => 'SHLPMN0165',
            'serial_number' => 'SHLPSN0165',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 166,
            'category_id' => 20,
            'part' => 'VZH028CGBNB (OLS)',
            'refrence' => 'Comp OLS + Drive CDS803P6K0T4E20H4',
            'model_number' => 'SHLPMN0166',
            'serial_number' => 'SHLPSN0166',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 167,
            'category_id' => 20,
            'part' => 'Oil Level Sensor 24Vac/dc (120Z0561)',
            'refrence' => 'Code no. 120Z0561 (Old version, obsolete)',
            'model_number' => 'SHLPMN0167',
            'serial_number' => 'SHLPSN0167',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 168,
            'category_id' => 20,
            'part' => 'Oil Level Sensor 24Vac/dc (120Z0803)',
            'refrence' => 'Code no. 120Z0803 (New version)',
            'model_number' => 'SHLPMN0168',
            'serial_number' => 'SHLPSN0168',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 169,
            'category_id' => 20,
            'part' => 'Oil Level Sensor 230V (120Z0562)',
            'refrence' => 'Code no. 120Z0562',
            'model_number' => 'SHLPMN0169',
            'serial_number' => 'SHLPSN0169',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 170,
            'category_id' => 23,
            'part' => 'ETS 8M40L-10 3/8\"',
            'refrence' => 'For IDAC10, IDAC15\nCode no. 034G8800\nCommon coil 034G8300 (2m)',
            'model_number' => 'SHLPMN0170',
            'serial_number' => 'SHLPSN0170',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 171,
            'category_id' => 23,
            'part' => 'ETS 8M40L-16 5/8\"',
            'refrence' => 'Code no.: 034G8801\nCommon coil 034G8300 (2m)',
            'model_number' => 'SHLPMN0171',
            'serial_number' => 'SHLPSN0171',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 172,
            'category_id' => 23,
            'part' => 'ETS 8M45L-16 5/8\"',
            'refrence' => 'For IDAC20, IDAC40\nCode no. 034G8805\nCommon coil 034G8300 (2m)',
            'model_number' => 'SHLPMN0172',
            'serial_number' => 'SHLPSN0172',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 173,
            'category_id' => 23,
            'part' => 'ETS 8M55L-16 5/8\"',
            'refrence' => 'For IDAC30, IDAC60\nCode no. 034G8808\nCommon coil 034G8300 (2m)',
            'model_number' => 'SHLPMN0173',
            'serial_number' => 'SHLPSN0173',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 174,
            'category_id' => 23,
            'part' => 'ETS 8M65L-16 5/8\"',
            'refrence' => 'Code no. 034G8810\nCommon coil 034G8300 (2m)',
            'model_number' => 'SHLPMN0174',
            'serial_number' => 'SHLPSN0174',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 175,
            'category_id' => 23,
            'part' => 'ETS 5M17L 1/4\"',
            'refrence' => 'Code no. 034G6207\nCoil 034G3802 (2.7m)\nPls note have extra 7 x 5M coil (May 2023)',
            'model_number' => 'SHLPMN0175',
            'serial_number' => 'SHLPSN0175',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 176,
            'category_id' => 23,
            'part' => 'ETS 5M24L 1/4\"',
            'refrence' => 'Code no. 034G6212\nCoil 034G3802 (2.7m)',
            'model_number' => 'SHLPMN0176',
            'serial_number' => 'SHLPSN0176',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 177,
            'category_id' => 23,
            'part' => 'ETS Colibri 25',
            'refrence' => 'Code no. 034G7602\nCoil 034G7074 (8m)',
            'model_number' => 'SHLPMN0177',
            'serial_number' => 'SHLPSN0177',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 178,
            'category_id' => 24,
            'part' => 'E2V30FSMC1',
            'refrence' => 'For IDAC10, IDAC15 Use. Unipolar. cPCO.\n3 pcs very old, dismantled from chiller',
            'model_number' => 'SHLPMN0178',
            'serial_number' => 'SHLPSN0178',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 179,
            'category_id' => 24,
            'part' => 'E3V45BSRC1',
            'refrence' => 'For IDAC20, IDAC40 Use. Unipolar. cPCO.',
            'model_number' => 'SHLPMN0179',
            'serial_number' => 'SHLPSN0179',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 180,
            'category_id' => 24,
            'part' => 'E3V55SSR10',
            'refrence' => 'For IDAC30, IDAC60 Use. Bipolar. PCO5\n2 pcs very old, dismantled from chiller',
            'model_number' => 'SHLPMN0180',
            'serial_number' => 'SHLPSN0180',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 181,
            'category_id' => 24,
            'part' => 'E3V45SSR10',
            'refrence' => 'Bipolar. PCO5.',
            'model_number' => 'SHLPMN0181',
            'serial_number' => 'SHLPSN0181',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 182,
            'category_id' => 24,
            'part' => 'E3V45ASR00',
            'refrence' => 'Bipolar. PCO5.',
            'model_number' => 'SHLPMN0182',
            'serial_number' => 'SHLPSN0182',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 183,
            'category_id' => 24,
            'part' => 'E4V85',
            'refrence' => 'Bipolar. PCO5.',
            'model_number' => 'SHLPMN0183',
            'serial_number' => 'SHLPSN0183',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 184,
            'category_id' => 25,
            'part' => 'E2V30SSM10',
            'refrence' => 'Bipolar. From Jojo, need to return?',
            'model_number' => 'SHLPMN0184',
            'serial_number' => 'SHLPSN0184',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 185,
            'category_id' => 25,
            'part' => 'E2V30USM10',
            'refrence' => 'Unipolar',
            'model_number' => 'SHLPMN0185',
            'serial_number' => 'SHLPSN0185',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 186,
            'category_id' => 25,
            'part' => 'E2V11SSF50',
            'refrence' => 'E2V Smart Uni. 12-12 ODF without sight glass, cable l = 2m, Copper Connections. Dismantled from BLDC 3HP',
            'model_number' => 'SHLPMN0186',
            'serial_number' => 'SHLPSN0186',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 187,
            'category_id' => 25,
            'part' => 'E3V35SSR50',
            'refrence' => null,
            'model_number' => 'SHLPMN0187',
            'serial_number' => 'SHLPSN0187',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 188,
            'category_id' => 25,
            'part' => 'E2V24FSFC0',
            'refrence' => 'EEV E2V24-F, 12-12 ODF w/o Stator',
            'model_number' => 'SHLPMN0188',
            'serial_number' => 'SHLPSN0188',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 189,
            'category_id' => 25,
            'part' => 'E2V11SSF50',
            'refrence' => 'E2V Smart Uni. 12-12 ODF without sight glass, cable l = 2m, Copper Connections. Dismantled from BLDC 3HP',
            'model_number' => 'SHLPMN0189',
            'serial_number' => 'SHLPSN0189',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:27'
        ]);

        Part::create([
            'id' => 190,
            'category_id' => 25,
            'part' => 'E3V35SSR50',
            'refrence' => null,
            'model_number' => 'SHLPMN0190',
            'serial_number' => 'SHLPSN0190',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:27',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 191,
            'category_id' => 25,
            'part' => 'E2V24FSFC0',
            'refrence' => 'EEV E2V24-F, 12-12 ODF w/o Stator',
            'model_number' => 'SHLPMN0191',
            'serial_number' => 'SHLPSN0191',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 192,
            'category_id' => 27,
            'part' => 'Fuji VSD 0.75K',
            'refrence' => 'FRN0002E2S-4GB',
            'model_number' => 'SHLPMN0192',
            'serial_number' => 'SHLPSN0192',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 193,
            'category_id' => 27,
            'part' => 'Fuji VSD 1.5K',
            'refrence' => 'FRN0004E2S-4GB',
            'model_number' => 'SHLPMN0193',
            'serial_number' => 'SHLPSN0193',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 194,
            'category_id' => 27,
            'part' => 'Fuji VSD 1.5K (OutDoor Use)',
            'refrence' => null,
            'model_number' => 'SHLPMN0194',
            'serial_number' => 'SHLPSN0194',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 195,
            'category_id' => 27,
            'part' => 'Fuji VSD 2.2K',
            'refrence' => 'FRN0006E2S-4GB',
            'model_number' => 'SHLPMN0195',
            'serial_number' => 'SHLPSN0195',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 196,
            'category_id' => 27,
            'part' => 'Fuji VSD 3K',
            'refrence' => 'FRN0007E2S-4GB',
            'model_number' => 'SHLPMN0196',
            'serial_number' => 'SHLPSN0196',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 197,
            'category_id' => 27,
            'part' => 'Fuji VSD 5.5K',
            'refrence' => 'FRN0012E2S-4GB',
            'model_number' => 'SHLPMN0197',
            'serial_number' => 'SHLPSN0197',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 198,
            'category_id' => 27,
            'part' => 'Fuji VSD 7.5K & 11K',
            'refrence' => 'FRN0022E2S-4GB',
            'model_number' => 'SHLPMN0198',
            'serial_number' => 'SHLPSN0198',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 199,
            'category_id' => 27,
            'part' => 'Fuji VSD 15K',
            'refrence' => 'FRN0029E2S-4GB',
            'model_number' => 'SHLPMN0199',
            'serial_number' => 'SHLPSN0199',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 200,
            'category_id' => 27,
            'part' => 'Fuji VSD 18.5K',
            'refrence' => 'FRN0037E2S-4GB',
            'model_number' => 'SHLPMN0200',
            'serial_number' => 'SHLPSN0200',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 201,
            'category_id' => 27,
            'part' => 'Fuji VSD 22K',
            'refrence' => 'FRN0044E2S-4GB',
            'model_number' => 'SHLPMN0201',
            'serial_number' => 'SHLPSN0201',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 202,
            'category_id' => 27,
            'part' => 'Fuji VSD 30K',
            'refrence' => 'FRN0059E2S-4GB',
            'model_number' => 'SHLPMN0202',
            'serial_number' => 'SHLPSN0202',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 203,
            'category_id' => 27,
            'part' => 'Fuji VSD 37K',
            'refrence' => 'FRN0072E2S-4GB',
            'model_number' => 'SHLPMN0203',
            'serial_number' => 'SHLPSN0203',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 204,
            'category_id' => 27,
            'part' => 'Fuji VSD 45K',
            'refrence' => 'FRN0085E2S-4GB',
            'model_number' => 'SHLPMN0204',
            'serial_number' => 'SHLPSN0204',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 205,
            'category_id' => 27,
            'part' => 'FRN0011E2S-7GB',
            'refrence' => 'FRN0011E2S 1 Phase VSD',
            'model_number' => 'SHLPMN0205',
            'serial_number' => 'SHLPSN0205',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 206,
            'category_id' => 27,
            'part' => 'FRN1.5AR1L-4A 1.5KW',
            'refrence' => 'FRN1.5AR1L-4A',
            'model_number' => 'SHLPMN0206',
            'serial_number' => 'SHLPSN0206',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 207,
            'category_id' => 28,
            'part' => 'Mitsubishi VSD 5.5K',
            'refrence' => 'OLD',
            'model_number' => 'SHLPMN0207',
            'serial_number' => 'SHLPSN0207',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 208,
            'category_id' => 28,
            'part' => 'Mitsubishi VSD 7.5K',
            'refrence' => 'Used unit',
            'model_number' => 'SHLPMN0208',
            'serial_number' => 'SHLPSN0208',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 209,
            'category_id' => 28,
            'part' => 'Mitsubishi VSD 15K',
            'refrence' => 'OLD',
            'model_number' => 'SHLPMN0209',
            'serial_number' => 'SHLPSN0209',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 210,
            'category_id' => 28,
            'part' => 'Mitsubishi VSD 18.5K',
            'refrence' => 'OLD',
            'model_number' => 'SHLPMN0210',
            'serial_number' => 'SHLPSN0210',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 211,
            'category_id' => 28,
            'part' => 'Mitsubishi VSD 22K',
            'refrence' => 'OLD',
            'model_number' => 'SHLPMN0211',
            'serial_number' => 'SHLPSN0211',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 212,
            'category_id' => 29,
            'part' => 'Delta VFD4A2MS43ANSAA (1.5kW)',
            'refrence' => null,
            'model_number' => 'SHLPMN0212',
            'serial_number' => 'SHLPSN0212',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 213,
            'category_id' => 29,
            'part' => 'Delta VFD150F43A (15kW)',
            'refrence' => null,
            'model_number' => 'SHLPMN0213',
            'serial_number' => 'SHLPSN0213',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 214,
            'category_id' => 30,
            'part' => 'Power+ 16A',
            'refrence' => 'PSD1016200 (will not order again)',
            'model_number' => 'SHLPMN0214',
            'serial_number' => 'SHLPSN0214',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 215,
            'category_id' => 30,
            'part' => 'Power+ 24A (15HP)',
            'refrence' => 'PSD1024400 (15HP) For IDAC15 with PSACH10200 choke (will not order again)',
            'model_number' => 'SHLPMN0215',
            'serial_number' => 'SHLPSN0215',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 216,
            'category_id' => 30,
            'part' => 'Power+ 18A (10HP)',
            'refrence' => 'PSD1018400 (10HP) For IDAC10 with PSACH10100 choke',
            'model_number' => 'SHLPMN0216',
            'serial_number' => 'SHLPSN0216',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 217,
            'category_id' => 30,
            'part' => 'Power+ 35A (15HP)',
            'refrence' => 'PSD1035420 (15HP) For IDAC15. No choke.',
            'model_number' => 'SHLPMN0217',
            'serial_number' => 'SHLPSN0217',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 218,
            'category_id' => 30,
            'part' => 'Power+ 40A (20HP)',
            'refrence' => 'PSD1040420 (20HP) For IDAC20, IDAC40. No choke.',
            'model_number' => 'SHLPMN0218',
            'serial_number' => 'SHLPSN0218',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 219,
            'category_id' => 31,
            'part' => 'CDS303P22KT4E20H2',
            'refrence' => 'IDAC60 Drive, use with VZH170CGANA (Norm)\nAt Ubi Store',
            'model_number' => 'SHLPMN0219',
            'serial_number' => 'SHLPSN0219',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 220,
            'category_id' => 31,
            'part' => 'CDS303P18KT4E20H2',
            'refrence' => 'Use with VZH117CGANA (Norm)',
            'model_number' => 'SHLPMN0220',
            'serial_number' => 'SHLPSN0220',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 221,
            'category_id' => 31,
            'part' => 'CDS303P15KT4E20H2 (134F9366)',
            'refrence' => 'Use with Comp VZH088CGDNA (Norm)',
            'model_number' => 'SHLPMN0221',
            'serial_number' => 'SHLPSN0221',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 222,
            'category_id' => 31,
            'part' => '',
            'refrence' => null,
            'model_number' => 'SHLPMN0222',
            'serial_number' => 'SHLPSN0222',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 223,
            'category_id' => 31,
            'part' => 'CDS303P15KT4E20H2 (135X1998)',
            'refrence' => 'Use with Comp VZH065CGDNB OLS',
            'model_number' => 'SHLPMN0223',
            'serial_number' => 'SHLPSN0223',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 224,
            'category_id' => 31,
            'part' => 'CDS303P11KT4E20H2',
            'refrence' => 'Use with Comp VZH052CGDNB OLS (Ubi Store)',
            'model_number' => 'SHLPMN0224',
            'serial_number' => 'SHLPSN0224',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 225,
            'category_id' => 31,
            'part' => '',
            'refrence' => null,
            'model_number' => 'SHLPMN0225',
            'serial_number' => 'SHLPSN0225',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 226,
            'category_id' => 31,
            'part' => 'CDS803P30KT4E20H2',
            'refrence' => 'Use with VZH170 Norm and OLS (Ubi Store-26/5/23)',
            'model_number' => 'SHLPMN0226',
            'serial_number' => 'SHLPSN0226',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 227,
            'category_id' => 31,
            'part' => 'CDS803P22KT4E20H2',
            'refrence' => 'Use with VZH117 Norm and OLS',
            'model_number' => 'SHLPMN0227',
            'serial_number' => 'SHLPSN0227',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 228,
            'category_id' => 31,
            'part' => 'CDS803P18KT4E20H2 (136U4910)',
            'refrence' => 'Use with Comp VZH088CGDNA OLS',
            'model_number' => 'SHLPMN0228',
            'serial_number' => 'SHLPSN0228',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 229,
            'category_id' => 31,
            'part' => 'CDS803P10KT4E20H4',
            'refrence' => 'Use with Comp VZH044CGBNB OLS',
            'model_number' => 'SHLPMN0229',
            'serial_number' => 'SHLPSN0229',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 230,
            'category_id' => 31,
            'part' => 'CDS803P7K5T4E20H4',
            'refrence' => 'Use with Comp VZH035CGBNB OLS (Ubi Store)',
            'model_number' => 'SHLPMN0230',
            'serial_number' => 'SHLPSN0230',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 231,
            'category_id' => 31,
            'part' => 'CDS803P6K0T4E20H4',
            'refrence' => 'Use with Comp VZH028CGBNB OLS',
            'model_number' => 'SHLPMN0231',
            'serial_number' => 'SHLPSN0231',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 232,
            'category_id' => 31,
            'part' => 'VLT Micro Drive FC-51 (0.75KW)',
            'refrence' => 'PN 132F0018 comes with LCP11',
            'model_number' => 'SHLPMN0232',
            'serial_number' => 'SHLPSN0232',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 233,
            'category_id' => 31,
            'part' => 'VLT Micro Drive FC-51 (5.5KW )',
            'refrence' => 'PN 132F0028, comes with LCP11 PN132B0100',
            'model_number' => 'SHLPMN0233',
            'serial_number' => 'SHLPSN0233',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 234,
            'category_id' => 31,
            'part' => 'VLT Micro Drive FC-51 (3.0KW )',
            'refrence' => 'PN 132F0024, comes with LCP11 PN132B0100',
            'model_number' => 'SHLPMN0234',
            'serial_number' => 'SHLPSN0234',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 235,
            'category_id' => 31,
            'part' => 'VLT Micro Drive FC-51 (4.0KW )',
            'refrence' => 'PN 132F0026, comes with LCP12 (From Taobao)',
            'model_number' => 'SHLPMN0235',
            'serial_number' => 'SHLPSN0235',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 236,
            'category_id' => 31,
            'part' => 'Control Panel LCP 102',
            'refrence' => 'PN 130B1107 (Code no. 120Z0326) for normal drive CDS303',
            'model_number' => 'SHLPMN0236',
            'serial_number' => 'SHLPSN0236',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 237,
            'category_id' => 31,
            'part' => 'Control Panel LCP 31',
            'refrence' => 'PN 132B0331 (Code no. 120Z0581) for small drive CDS803',
            'model_number' => 'SHLPMN0237',
            'serial_number' => 'SHLPSN0237',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 238,
            'category_id' => 47,
            'part' => 'AC1 Oil (cPCO)',
            'refrence' => null,
            'model_number' => 'SHLPMN0238',
            'serial_number' => 'SHLPSN0238',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 239,
            'category_id' => 47,
            'part' => 'AC1 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0239',
            'serial_number' => 'SHLPSN0239',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 240,
            'category_id' => 47,
            'part' => 'AC2 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0240',
            'serial_number' => 'SHLPSN0240',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 241,
            'category_id' => 47,
            'part' => 'AC3 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0241',
            'serial_number' => 'SHLPSN0241',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 242,
            'category_id' => 47,
            'part' => 'AC5 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0242',
            'serial_number' => 'SHLPSN0242',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 243,
            'category_id' => 47,
            'part' => 'AC8 (?C2SE)',
            'refrence' => null,
            'model_number' => 'SHLPMN0243',
            'serial_number' => 'SHLPSN0243',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 244,
            'category_id' => 47,
            'part' => 'AC3 (Customized)',
            'refrence' => null,
            'model_number' => 'SHLPMN0244',
            'serial_number' => 'SHLPSN0244',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 245,
            'category_id' => 47,
            'part' => 'IDAC10',
            'refrence' => null,
            'model_number' => 'SHLPMN0245',
            'serial_number' => 'SHLPSN0245',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 246,
            'category_id' => 47,
            'part' => 'IAC10 (Old)',
            'refrence' => null,
            'model_number' => 'SHLPMN0246',
            'serial_number' => 'SHLPSN0246',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 247,
            'category_id' => 47,
            'part' => 'IDAC15',
            'refrence' => null,
            'model_number' => 'SHLPMN0247',
            'serial_number' => 'SHLPSN0247',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 248,
            'category_id' => 47,
            'part' => 'IDAC20',
            'refrence' => null,
            'model_number' => 'SHLPMN0248',
            'serial_number' => 'SHLPSN0248',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 249,
            'category_id' => 47,
            'part' => 'IMAC25 (Old)',
            'refrence' => null,
            'model_number' => 'SHLPMN0249',
            'serial_number' => 'SHLPSN0249',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 250,
            'category_id' => 47,
            'part' => 'IDAC30',
            'refrence' => null,
            'model_number' => 'SHLPMN0250',
            'serial_number' => 'SHLPSN0250',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 251,
            'category_id' => 47,
            'part' => 'IDAC40',
            'refrence' => null,
            'model_number' => 'SHLPMN0251',
            'serial_number' => 'SHLPSN0251',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 252,
            'category_id' => 47,
            'part' => 'IDAC60',
            'refrence' => null,
            'model_number' => 'SHLPMN0252',
            'serial_number' => 'SHLPSN0252',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 253,
            'category_id' => 47,
            'part' => 'AC3 (Split) R410A',
            'refrence' => null,
            'model_number' => 'SHLPMN0253',
            'serial_number' => 'SHLPSN0253',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 254,
            'category_id' => 47,
            'part' => 'AC5 (Split) R410A',
            'refrence' => null,
            'model_number' => 'SHLPMN0254',
            'serial_number' => 'SHLPSN0254',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 255,
            'category_id' => 47,
            'part' => 'IDAC10 (Split) ',
            'refrence' => null,
            'model_number' => 'SHLPMN0255',
            'serial_number' => 'SHLPSN0255',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 256,
            'category_id' => 47,
            'part' => 'IDAC15 (Split) ',
            'refrence' => null,
            'model_number' => 'SHLPMN0256',
            'serial_number' => 'SHLPSN0256',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 257,
            'category_id' => 47,
            'part' => 'IDAC20 (Split) ',
            'refrence' => null,
            'model_number' => 'SHLPMN0257',
            'serial_number' => 'SHLPSN0257',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 258,
            'category_id' => 47,
            'part' => 'IDAC30 (Split) ',
            'refrence' => null,
            'model_number' => 'SHLPMN0258',
            'serial_number' => 'SHLPSN0258',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 259,
            'category_id' => 49,
            'part' => 'HX5',
            'refrence' => null,
            'model_number' => 'SHLPMN0259',
            'serial_number' => 'SHLPSN0259',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 260,
            'category_id' => 49,
            'part' => 'HX10',
            'refrence' => null,
            'model_number' => 'SHLPMN0260',
            'serial_number' => 'SHLPSN0260',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 261,
            'category_id' => 51,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0261',
            'serial_number' => 'SHLPSN0261',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 262,
            'category_id' => 53,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0262',
            'serial_number' => 'SHLPSN0262',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 263,
            'category_id' => 55,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0263',
            'serial_number' => 'SHLPSN0263',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 264,
            'category_id' => 33,
            'part' => 'SAE-HX1',
            'refrence' => 'B4Mx16-2.5kW',
            'model_number' => 'SHLPMN0264',
            'serial_number' => 'SHLPSN0264',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 265,
            'category_id' => 33,
            'part' => 'SAE-HX2',
            'refrence' => 'B4Mx28-5kW',
            'model_number' => 'SHLPMN0265',
            'serial_number' => 'SHLPSN0265',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 266,
            'category_id' => 33,
            'part' => 'SAE-HX3',
            'refrence' => 'B25Tx16-7.5kW',
            'model_number' => 'SHLPMN0266',
            'serial_number' => 'SHLPSN0266',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 267,
            'category_id' => 33,
            'part' => 'SAE-HX5',
            'refrence' => 'V25Tx20-12.5kW',
            'model_number' => 'SHLPMN0267',
            'serial_number' => 'SHLPSN0267',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 268,
            'category_id' => 34,
            'part' => 'SAE-HX5 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0268',
            'serial_number' => 'SHLPSN0268',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 269,
            'category_id' => 33,
            'part' => 'SAE-HX10',
            'refrence' => 'V80x32-25kW / V80Hx26',
            'model_number' => 'SHLPMN0269',
            'serial_number' => 'SHLPSN0269',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 270,
            'category_id' => 33,
            'part' => 'SAE-HX15 ',
            'refrence' => 'V80x44-37.5kW',
            'model_number' => 'SHLPMN0270',
            'serial_number' => 'SHLPSN0270',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 271,
            'category_id' => 33,
            'part' => 'SAE-HX20 Dual Circuit ',
            'refrence' => 'DVD200x26-50kW',
            'model_number' => 'SHLPMN0271',
            'serial_number' => 'SHLPSN0271',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 272,
            'category_id' => 33,
            'part' => 'SAE-HX20 Single Circuit',
            'refrence' => 'V80x52/1P-NC-S',
            'model_number' => 'SHLPMN0272',
            'serial_number' => 'SHLPSN0272',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 273,
            'category_id' => 33,
            'part' => 'SAE-HX25 Single Circuit',
            'refrence' => 'V80Hx68',
            'model_number' => 'SHLPMN0273',
            'serial_number' => 'SHLPSN0273',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 274,
            'category_id' => 33,
            'part' => 'SAE-HX30 Single Circuit',
            'refrence' => 'V80Hx76',
            'model_number' => 'SHLPMN0274',
            'serial_number' => 'SHLPSN0274',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 275,
            'category_id' => 33,
            'part' => 'SAE-HX40 Dual Circuit ',
            'refrence' => 'DV200Hx58 / F80Hx54x54/1P-SC-M',
            'model_number' => 'SHLPMN0275',
            'serial_number' => 'SHLPSN0275',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 276,
            'category_id' => 33,
            'part' => 'SAE-HX60 Dual Circuit ',
            'refrence' => 'DV200Hx94 / DV300x90/1P-SC-M',
            'model_number' => 'SHLPMN0276',
            'serial_number' => 'SHLPSN0276',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 277,
            'category_id' => 34,
            'part' => 'SAE-HX2 (A)',
            'refrence' => 'B80Hx30',
            'model_number' => 'SHLPMN0277',
            'serial_number' => 'SHLPSN0277',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 278,
            'category_id' => 34,
            'part' => 'SAE-HX3 (A)',
            'refrence' => 'B10Tx104',
            'model_number' => 'SHLPMN0278',
            'serial_number' => 'SHLPSN0278',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 279,
            'category_id' => 35,
            'part' => 'SAE-HX5 (C)',
            'refrence' => 'B85x32/1P-SC-M',
            'model_number' => 'SHLPMN0279',
            'serial_number' => 'SHLPSN0279',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 280,
            'category_id' => 35,
            'part' => 'SAE-HX10 (C)',
            'refrence' => 'B85x60/1P-SC-M',
            'model_number' => 'SHLPMN0280',
            'serial_number' => 'SHLPSN0280',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 281,
            'category_id' => 35,
            'part' => 'SAE-HX15 (C)',
            'refrence' => 'B85x90/1P-SC-M',
            'model_number' => 'SHLPMN0281',
            'serial_number' => 'SHLPSN0281',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 282,
            'category_id' => 35,
            'part' => 'SAE-HX20 (C)',
            'refrence' => 'B85x118/1P-SC-M',
            'model_number' => 'SHLPMN0282',
            'serial_number' => 'SHLPSN0282',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 283,
            'category_id' => 36,
            'part' => 'B5THx20/1P',
            'refrence' => 'Water to Water Heat Exchanger',
            'model_number' => 'SHLPMN0283',
            'serial_number' => 'SHLPSN0283',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 284,
            'category_id' => 36,
            'part' => 'BX4THx64',
            'refrence' => '5HP Water to Water',
            'model_number' => 'SHLPMN0284',
            'serial_number' => 'SHLPSN0284',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 285,
            'category_id' => 36,
            'part' => 'B80Hx30/1P',
            'refrence' => 'HX10',
            'model_number' => 'SHLPMN0285',
            'serial_number' => 'SHLPSN0285',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 286,
            'category_id' => 36,
            'part' => 'B12MTx30/1P-SC-S',
            'refrence' => 'Water to Water Heat Exchanger. WF WC3 Helium Block.',
            'model_number' => 'SHLPMN0286',
            'serial_number' => 'SHLPSN0286',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 287,
            'category_id' => 36,
            'part' => 'BH30B*62D',
            'refrence' => null,
            'model_number' => 'SHLPMN0287',
            'serial_number' => 'SHLPSN0287',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 288,
            'category_id' => 36,
            'part' => 'B10THx40/1P',
            'refrence' => null,
            'model_number' => 'SHLPMN0288',
            'serial_number' => 'SHLPSN0288',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 289,
            'category_id' => 37,
            'part' => 'SAE-AC5',
            'refrence' => null,
            'model_number' => 'SHLPMN0289',
            'serial_number' => 'SHLPSN0289',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 290,
            'category_id' => 37,
            'part' => 'ZL52B-(16+16)X',
            'refrence' => 'From Alexandra Hospital, at Office Back Store',
            'model_number' => 'SHLPMN0290',
            'serial_number' => 'SHLPSN0290',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 291,
            'category_id' => 37,
            'part' => 'ZL95B-66D',
            'refrence' => 'Single Circuit, at Office Back Store',
            'model_number' => 'SHLPMN0291',
            'serial_number' => 'SHLPSN0291',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 292,
            'category_id' => 37,
            'part' => 'IHRU40 Heat Recovery Module',
            'refrence' => '30/10/2018,working condition,check before use. Dismantled from AIH Heat Recovery Module',
            'model_number' => 'SHLPMN0292',
            'serial_number' => 'SHLPSN0292',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 293,
            'category_id' => 37,
            'part' => 'SWEP B8Tx26',
            'refrence' => 'C&W IHRU7 (2018), at Office Back Store',
            'model_number' => 'SHLPMN0293',
            'serial_number' => 'SHLPSN0293',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:28'
        ]);

        Part::create([
            'id' => 294,
            'category_id' => 37,
            'part' => 'SWEP DPD300-230/1P-SC-M',
            'refrence' => '80HP Evaporator. Used from Probiz MAC80. Dual Circuit.',
            'model_number' => 'SHLPMN0294',
            'serial_number' => 'SHLPSN0294',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:28',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 295,
            'category_id' => 37,
            'part' => 'B25THX104-1PSC-S (Swep)',
            'refrence' => 'Office Back Store',
            'model_number' => 'SHLPMN0295',
            'serial_number' => 'SHLPSN0295',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 296,
            'category_id' => 37,
            'part' => 'B25X038',
            'refrence' => 'Year 1995, at Office Back Store',
            'model_number' => 'SHLPMN0296',
            'serial_number' => 'SHLPSN0296',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 297,
            'category_id' => 37,
            'part' => 'BH30B-16D',
            'refrence' => 'Office Back Store',
            'model_number' => 'SHLPMN0297',
            'serial_number' => 'SHLPSN0297',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 298,
            'category_id' => 37,
            'part' => '60HP Heat Exchanger',
            'refrence' => 'NOT SAE-HX60',
            'model_number' => 'SHLPMN0298',
            'serial_number' => 'SHLPSN0298',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 299,
            'category_id' => 38,
            'part' => 'SAE-TL3',
            'refrence' => 'TL-3HEC',
            'model_number' => 'SHLPMN0299',
            'serial_number' => 'SHLPSN0299',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 300,
            'category_id' => 38,
            'part' => 'SAE-TL5',
            'refrence' => 'TL-5HEC',
            'model_number' => 'SHLPMN0300',
            'serial_number' => 'SHLPSN0300',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 301,
            'category_id' => 38,
            'part' => 'SAE-TL10',
            'refrence' => 'TL-10HEC',
            'model_number' => 'SHLPMN0301',
            'serial_number' => 'SHLPSN0301',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 302,
            'category_id' => 38,
            'part' => 'SAE-TL15',
            'refrence' => 'TL-15HEC',
            'model_number' => 'SHLPMN0302',
            'serial_number' => 'SHLPSN0302',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 303,
            'category_id' => 38,
            'part' => 'SAE-Ti1',
            'refrence' => 'Titanium. Model: SS-0075GTi-U ( LIKELY TO BE UNDERSIZED , DO NOT USE )',
            'model_number' => 'SHLPMN0303',
            'serial_number' => 'SHLPSN0303',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 304,
            'category_id' => 38,
            'part' => 'SAE-Ti2',
            'refrence' => 'Titanium. Model: SS-0225GTi-U',
            'model_number' => 'SHLPMN0304',
            'serial_number' => 'SHLPSN0304',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 305,
            'category_id' => 38,
            'part' => 'SAE-Ti5',
            'refrence' => 'Titanium. Model: SS-0250GSTi-F',
            'model_number' => 'SHLPMN0305',
            'serial_number' => 'SHLPSN0305',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 306,
            'category_id' => 38,
            'part' => 'SAE-Ti10',
            'refrence' => 'Titanium. Model: SS-0480GSTi-F2',
            'model_number' => 'SHLPMN0306',
            'serial_number' => 'SHLPSN0306',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 307,
            'category_id' => 38,
            'part' => '5HP SS-0150GST',
            'refrence' => null,
            'model_number' => 'SHLPMN0307',
            'serial_number' => 'SHLPSN0307',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 308,
            'category_id' => 38,
            'part' => 'SS-0150GSTi-F',
            'refrence' => 'WF WC3 Heat Exchanger (Condenser) Stock',
            'model_number' => 'SHLPMN0308',
            'serial_number' => 'SHLPSN0308',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 309,
            'category_id' => 38,
            'part' => 'SS-0225GT-U',
            'refrence' => '5HP Condenser Co-Axial, can be used as 3P Evaporator',
            'model_number' => 'SHLPMN0309',
            'serial_number' => 'SHLPSN0309',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 310,
            'category_id' => 38,
            'part' => 'SS-0075GT-U',
            'refrence' => '3HP Condenser Co-Axial Coil, can be used as 2P Evaporator',
            'model_number' => 'SHLPMN0310',
            'serial_number' => 'SHLPSN0310',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 311,
            'category_id' => 39,
            'part' => '10P??PVC?? ',
            'refrence' => 'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.5d562e8dOoik76&id=543821382091&_u=l21s5bhedb79',
            'model_number' => 'SHLPMN0311',
            'serial_number' => 'SHLPSN0311',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 312,
            'category_id' => 39,
            'part' => 'V25Tx80/1P',
            'refrence' => 'RWS Spares : 45 kW Evap or 55 kW Condenser - Std Condition - SWEP',
            'model_number' => 'SHLPMN0312',
            'serial_number' => 'SHLPSN0312',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 313,
            'category_id' => 39,
            'part' => 'F80Hx100/1P',
            'refrence' => 'RWS Spares : 80 kW Evap or 80 kW Condenser - Std Condition - SWEP',
            'model_number' => 'SHLPMN0313',
            'serial_number' => 'SHLPSN0313',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 314,
            'category_id' => 39,
            'part' => 'P80H*80/1P',
            'refrence' => null,
            'model_number' => 'SHLPMN0314',
            'serial_number' => 'SHLPSN0314',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 315,
            'category_id' => 40,
            'part' => 'SAE-HX5 (SS)',
            'refrence' => ' CHINA BANGTAI - Full Stainless Steel. Max Pressure 45kg / 600 PSI - SA027-50-4.5-H',
            'model_number' => 'SHLPMN0315',
            'serial_number' => 'SHLPSN0315',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 316,
            'category_id' => 40,
            'part' => 'SAE-HX5 (SS) - 5kW',
            'refrence' => ' CHINA BANGTAI - Full Stainless Steel - SA027-20-4.5-H',
            'model_number' => 'SHLPMN0316',
            'serial_number' => 'SHLPSN0316',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 317,
            'category_id' => 40,
            'part' => 'SAE-HX10 (SS)',
            'refrence' => ' CHINA BANGTAI - SA052-40-4.5-HQ',
            'model_number' => 'SHLPMN0317',
            'serial_number' => 'SHLPSN0317',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 318,
            'category_id' => 40,
            'part' => 'SAE-HX15 (SS)',
            'refrence' => ' CHINA BANGTAI - SA060-40-4.5-HQ',
            'model_number' => 'SHLPMN0318',
            'serial_number' => 'SHLPSN0318',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 319,
            'category_id' => 39,
            'part' => 'P80H*66/1P',
            'refrence' => null,
            'model_number' => 'SHLPMN0319',
            'serial_number' => 'SHLPSN0319',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 320,
            'category_id' => 42,
            'part' => 'SAE-CU1',
            'refrence' => '480 x 480 x 210mm No Fan. Old short AC1 use. Copper Type',
            'model_number' => 'SHLPMN0320',
            'serial_number' => 'SHLPSN0320',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 321,
            'category_id' => 42,
            'part' => 'SAE-MCU1',
            'refrence' => null,
            'model_number' => 'SHLPMN0321',
            'serial_number' => 'SHLPSN0321',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 322,
            'category_id' => 42,
            'part' => 'SAE-MCU2',
            'refrence' => 'CCWTD-8',
            'model_number' => 'SHLPMN0322',
            'serial_number' => 'SHLPSN0322',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 323,
            'category_id' => 42,
            'part' => 'SAE-MCU3',
            'refrence' => 'L 740 x H 625 x B 200mm with Fan',
            'model_number' => 'SHLPMN0323',
            'serial_number' => 'SHLPSN0323',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 324,
            'category_id' => 42,
            'part' => 'SAE-MCU5',
            'refrence' => null,
            'model_number' => 'SHLPMN0324',
            'serial_number' => 'SHLPSN0324',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 325,
            'category_id' => 42,
            'part' => 'SAE-MCU7',
            'refrence' => null,
            'model_number' => 'SHLPMN0325',
            'serial_number' => 'SHLPSN0325',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 326,
            'category_id' => 42,
            'part' => 'SAE-MCU10 (Single Fan)',
            'refrence' => 'Single Fan Design',
            'model_number' => 'SHLPMN0326',
            'serial_number' => 'SHLPSN0326',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 327,
            'category_id' => 42,
            'part' => 'SAE-MCU15 (Single Fan)',
            'refrence' => 'Single Fan Design. ',
            'model_number' => 'SHLPMN0327',
            'serial_number' => 'SHLPSN0327',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 328,
            'category_id' => 42,
            'part' => 'SAE-MCU20 ( Single Fan )',
            'refrence' => 'Squarish Type from IDAC20 Split',
            'model_number' => 'SHLPMN0328',
            'serial_number' => 'SHLPSN0328',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 329,
            'category_id' => 42,
            'part' => 'SAE-MCU30',
            'refrence' => null,
            'model_number' => 'SHLPMN0329',
            'serial_number' => 'SHLPSN0329',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 330,
            'category_id' => 43,
            'part' => 'SAE-IAC10 Side Coil LEFT',
            'refrence' => 'Epoxy 1352-017-012-015L/R',
            'model_number' => 'SHLPMN0330',
            'serial_number' => 'SHLPSN0330',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 331,
            'category_id' => 43,
            'part' => 'SAE-IAC10 Side Coil RIGHT',
            'refrence' => 'Epoxy 1352-017-012-015L/R',
            'model_number' => 'SHLPMN0331',
            'serial_number' => 'SHLPSN0331',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 332,
            'category_id' => 43,
            'part' => '750mm ? 930mm Microchanel',
            'refrence' => 'Epoxy, dismantle from dont know where. Pressure test ok.',
            'model_number' => 'SHLPMN0332',
            'serial_number' => 'SHLPSN0332',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 333,
            'category_id' => 43,
            'part' => 'Condensing coil 15HP',
            'refrence' => 'Condensing coil 15HP heresite coated. L = 1750 H = 1140mm',
            'model_number' => 'SHLPMN0333',
            'serial_number' => 'SHLPSN0333',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 334,
            'category_id' => 43,
            'part' => 'Condensing coil 60HP',
            'refrence' => 'Condensing coil 60HP heresite coated. L = 2025 H = 1200mm',
            'model_number' => 'SHLPMN0334',
            'serial_number' => 'SHLPSN0334',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 335,
            'category_id' => 43,
            'part' => 'Dry Coil',
            'refrence' => ' - 2360 x 1240 mm, internal 2 holes diameter 925 mm, with 2 x water pipes 2\"',
            'model_number' => 'SHLPMN0335',
            'serial_number' => 'SHLPSN0335',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 336,
            'category_id' => 44,
            'part' => 'SAE-AC1 Fan',
            'refrence' => 'YWF6E-400S-102/47-G',
            'model_number' => 'SHLPMN0336',
            'serial_number' => 'SHLPSN0336',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 337,
            'category_id' => 44,
            'part' => 'SAE-AC2 Fan',
            'refrence' => 'YWF4E-400S-102/47-G / YDWF74L47P4-470N-400 (Maer)',
            'model_number' => 'SHLPMN0337',
            'serial_number' => 'SHLPSN0337',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 338,
            'category_id' => 44,
            'part' => 'SAE-AC3 Fan',
            'refrence' => 'YWF4D-450S-102/60-G / YSWF74L60P4-522N-450 (Maer)',
            'model_number' => 'SHLPMN0338',
            'serial_number' => 'SHLPSN0338',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 339,
            'category_id' => 44,
            'part' => 'SAE-AC5 Fan',
            'refrence' => 'YWF4D-500S-137/35-G / Same Model as MCU10 Fan',
            'model_number' => 'SHLPMN0339',
            'serial_number' => 'SHLPSN0339',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 340,
            'category_id' => 44,
            'part' => 'SAE-AC8 Fan',
            'refrence' => 'RYF-630C-B5-6-0.55kW / YSWF102L60P4-675N-600 (Maer)',
            'model_number' => 'SHLPMN0340',
            'serial_number' => 'SHLPSN0340',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 341,
            'category_id' => 44,
            'part' => 'SAE-IAC10 Fan',
            'refrence' => 'RYF-660-6-0.55KW / YSWF102L70P4-753N-630 (Maer)',
            'model_number' => 'SHLPMN0341',
            'serial_number' => 'SHLPSN0341',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 342,
            'category_id' => 44,
            'part' => 'SAE-IAC15 Fan',
            'refrence' => 'RYF-760C-B5-1.1KW / YSWF127L80P6-920N-800 (Maer)',
            'model_number' => 'SHLPMN0342',
            'serial_number' => 'SHLPSN0342',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 343,
            'category_id' => 44,
            'part' => 'SAE-IDAC20 Fan',
            'refrence' => '800FZL-J4NX33LS8D78Q',
            'model_number' => 'SHLPMN0343',
            'serial_number' => 'SHLPSN0343',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 344,
            'category_id' => 44,
            'part' => 'SAE-IAC20 Fan',
            'refrence' => 'YGAS-800D-160B5-6-2.2 ',
            'model_number' => 'SHLPMN0344',
            'serial_number' => 'SHLPSN0344',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 345,
            'category_id' => 44,
            'part' => 'SAE-IMAC25 Fan',
            'refrence' => 'RYF-760D-1.25kW',
            'model_number' => 'SHLPMN0345',
            'serial_number' => 'SHLPSN0345',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 346,
            'category_id' => 44,
            'part' => 'SAE-IMAC40 Fan',
            'refrence' => 'RYF-800D-90-6-1.5',
            'model_number' => 'SHLPMN0346',
            'serial_number' => 'SHLPSN0346',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 347,
            'category_id' => 44,
            'part' => 'SAE-IMAC60 Fan',
            'refrence' => 'RYF-855D-190B5-6-2.2. 4 Piece is old from HP site.',
            'model_number' => 'SHLPMN0347',
            'serial_number' => 'SHLPSN0347',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 348,
            'category_id' => 44,
            'part' => 'SAE-IDAC60 Fan',
            'refrence' => '900FZL-C4X30LS6DQ',
            'model_number' => 'SHLPMN0348',
            'serial_number' => 'SHLPSN0348',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 349,
            'category_id' => 44,
            'part' => 'SAE-MCU2 Fan',
            'refrence' => null,
            'model_number' => 'SHLPMN0349',
            'serial_number' => 'SHLPSN0349',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 350,
            'category_id' => 44,
            'part' => 'SAE-MCU5 Fan',
            'refrence' => 'YWF4D-550S',
            'model_number' => 'SHLPMN0350',
            'serial_number' => 'SHLPSN0350',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 351,
            'category_id' => 44,
            'part' => 'SAE-MCU10 (Two Fan Design) Fan',
            'refrence' => '500mm / Same model as AC5 Fan\n2 pcs - Old one',
            'model_number' => 'SHLPMN0351',
            'serial_number' => 'SHLPSN0351',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 352,
            'category_id' => 44,
            'part' => 'SAE-MCU10 (Single Fan Design) Fan',
            'refrence' => 'YSWF127L50P6-840N-710 (Low Noise)',
            'model_number' => 'SHLPMN0352',
            'serial_number' => 'SHLPSN0352',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 353,
            'category_id' => 44,
            'part' => 'SAE-MCU15 (Two Fan Design) Fan',
            'refrence' => 'YSWF102L60P4-725N-600',
            'model_number' => 'SHLPMN0353',
            'serial_number' => 'SHLPSN0353',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 354,
            'category_id' => 44,
            'part' => 'SAE-MCU20 Fan',
            'refrence' => null,
            'model_number' => 'SHLPMN0354',
            'serial_number' => 'SHLPSN0354',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 355,
            'category_id' => 44,
            'part' => 'YDWF74L47P6-470N-400S',
            'refrence' => 'Undersized for AC2 (R410A)',
            'model_number' => 'SHLPMN0355',
            'serial_number' => 'SHLPSN0355',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 356,
            'category_id' => 44,
            'part' => 'YDWF74L60P4-470N-400',
            'refrence' => 'Ordered for AC2 (R410A)',
            'model_number' => 'SHLPMN0356',
            'serial_number' => 'SHLPSN0356',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 357,
            'category_id' => 44,
            'part' => 'YDWF68L25P4-300P-250',
            'refrence' => 'Removed from old AC1 (R410A)',
            'model_number' => 'SHLPMN0357',
            'serial_number' => 'SHLPSN0357',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 358,
            'category_id' => 44,
            'part' => 'YSWF127L80P4-753N-630-7',
            'refrence' => null,
            'model_number' => 'SHLPMN0358',
            'serial_number' => 'SHLPSN0358',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 359,
            'category_id' => 44,
            'part' => 'YSWF-102L35P4-570N-500S',
            'refrence' => 'Fan for CCWTD14',
            'model_number' => 'SHLPMN0359',
            'serial_number' => 'SHLPSN0359',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 360,
            'category_id' => 58,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0360',
            'serial_number' => 'SHLPSN0360',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 361,
            'category_id' => 59,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0361',
            'serial_number' => 'SHLPSN0361',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 362,
            'category_id' => 61,
            'part' => '500L Open',
            'refrence' => null,
            'model_number' => 'SHLPMN0362',
            'serial_number' => 'SHLPSN0362',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 363,
            'category_id' => 62,
            'part' => '400 x 400 x 400mm',
            'refrence' => null,
            'model_number' => 'SHLPMN0363',
            'serial_number' => 'SHLPSN0363',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 364,
            'category_id' => 63,
            'part' => '300L',
            'refrence' => 'Piggy Back Tank with White Panels and Profile',
            'model_number' => 'SHLPMN0364',
            'serial_number' => 'SHLPSN0364',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 365,
            'category_id' => 64,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0365',
            'serial_number' => 'SHLPSN0365',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 366,
            'category_id' => 68,
            'part' => 'AC1 Oil (cPCO)',
            'refrence' => null,
            'model_number' => 'SHLPMN0366',
            'serial_number' => 'SHLPSN0366',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 367,
            'category_id' => 68,
            'part' => 'AC1 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0367',
            'serial_number' => 'SHLPSN0367',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 368,
            'category_id' => 68,
            'part' => 'AC2 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0368',
            'serial_number' => 'SHLPSN0368',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 369,
            'category_id' => 68,
            'part' => 'AC3 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0369',
            'serial_number' => 'SHLPSN0369',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 370,
            'category_id' => 68,
            'part' => 'AC5 (R410A)',
            'refrence' => null,
            'model_number' => 'SHLPMN0370',
            'serial_number' => 'SHLPSN0370',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 371,
            'category_id' => 68,
            'part' => 'AC8 (µC2SE)',
            'refrence' => null,
            'model_number' => 'SHLPMN0371',
            'serial_number' => 'SHLPSN0371',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 372,
            'category_id' => 68,
            'part' => 'AC3 (Customized)',
            'refrence' => null,
            'model_number' => 'SHLPMN0372',
            'serial_number' => 'SHLPSN0372',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 373,
            'category_id' => 68,
            'part' => 'IDAC10',
            'refrence' => null,
            'model_number' => 'SHLPMN0373',
            'serial_number' => 'SHLPSN0373',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 374,
            'category_id' => 68,
            'part' => 'IAC10 (Old)',
            'refrence' => null,
            'model_number' => 'SHLPMN0374',
            'serial_number' => 'SHLPSN0374',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 375,
            'category_id' => 68,
            'part' => 'IDAC15',
            'refrence' => null,
            'model_number' => 'SHLPMN0375',
            'serial_number' => 'SHLPSN0375',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 376,
            'category_id' => 68,
            'part' => 'IDAC20',
            'refrence' => null,
            'model_number' => 'SHLPMN0376',
            'serial_number' => 'SHLPSN0376',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 377,
            'category_id' => 68,
            'part' => 'IMAC25 (Old)',
            'refrence' => null,
            'model_number' => 'SHLPMN0377',
            'serial_number' => 'SHLPSN0377',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 378,
            'category_id' => 68,
            'part' => 'IDAC30',
            'refrence' => null,
            'model_number' => 'SHLPMN0378',
            'serial_number' => 'SHLPSN0378',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 379,
            'category_id' => 68,
            'part' => 'IDAC40',
            'refrence' => null,
            'model_number' => 'SHLPMN0379',
            'serial_number' => 'SHLPSN0379',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 380,
            'category_id' => 68,
            'part' => 'IDAC60',
            'refrence' => null,
            'model_number' => 'SHLPMN0380',
            'serial_number' => 'SHLPSN0380',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 381,
            'category_id' => 68,
            'part' => 'AC3 (Split) R410A',
            'refrence' => null,
            'model_number' => 'SHLPMN0381',
            'serial_number' => 'SHLPSN0381',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 382,
            'category_id' => 68,
            'part' => 'AC5 (Split) R410A',
            'refrence' => null,
            'model_number' => 'SHLPMN0382',
            'serial_number' => 'SHLPSN0382',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 383,
            'category_id' => 68,
            'part' => 'IDAC10 (Split)',
            'refrence' => null,
            'model_number' => 'SHLPMN0383',
            'serial_number' => 'SHLPSN0383',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 384,
            'category_id' => 68,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0384',
            'serial_number' => 'SHLPSN0384',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 385,
            'category_id' => 68,
            'part' => 'IDAC 15 (Split)',
            'refrence' => null,
            'model_number' => 'SHLPMN0385',
            'serial_number' => 'SHLPSN0385',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 386,
            'category_id' => 68,
            'part' => 'IDAC 20 (Split)',
            'refrence' => null,
            'model_number' => 'SHLPMN0386',
            'serial_number' => 'SHLPSN0386',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 387,
            'category_id' => 68,
            'part' => 'IDAC 30 (Split)',
            'refrence' => null,
            'model_number' => 'SHLPMN0387',
            'serial_number' => 'SHLPSN0387',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 388,
            'category_id' => 70,
            'part' => 'HX5',
            'refrence' => null,
            'model_number' => 'SHLPMN0388',
            'serial_number' => 'SHLPSN0388',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 389,
            'category_id' => 70,
            'part' => 'HX10',
            'refrence' => null,
            'model_number' => 'SHLPMN0389',
            'serial_number' => 'SHLPSN0389',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 390,
            'category_id' => 72,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0390',
            'serial_number' => 'SHLPSN0390',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 391,
            'category_id' => 74,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0391',
            'serial_number' => 'SHLPSN0391',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        Part::create([
            'id' => 392,
            'category_id' => 76,
            'part' => 'TBA',
            'refrence' => null,
            'model_number' => 'SHLPMN0392',
            'serial_number' => 'SHLPSN0392',
            'quantity' => '100',
            'status' => 1,
            'created_at' => '2023-10-11 10:54:29',
            'updated_at' => '2023-10-11 10:54:29'
        ]);

        $parts = Part::get();

        foreach ($parts as $key => $part) {
            for ($i = 1; $i < $part->quantity + 1; $i++) {
                PartSerialNo::create([
                    "part_id" => $part->id,
                    "serial_no" => "SHL" . $part->id . '0000' . $i
                ]);
            }
        }
    }
}
