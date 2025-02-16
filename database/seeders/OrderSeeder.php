<?php

namespace Database\Seeders;

use App\Models\InventoryEquipment;
use App\Models\InventoryEquipmentPart;
use App\Models\InventoryEquipmentSerialNo;
use App\Models\Order;
use App\Models\OrderDocument;
use App\Models\OrderHistory;
use App\Models\OrderImage;
use App\Models\OrderPart;
use App\Models\Part;
use App\Models\PartSerialNo;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $users = User::get();

        foreach ($users as $user) {
            $warranty_upto              = $faker->randomElement(['12', '18', '24', '36', 'custom']);
            $equipment_assemble_type    = $faker->randomElement(['inventory', 'supplier']);

            if ($equipment_assemble_type == 'inventory') {
                $existing_equipment  = InventoryEquipment::find($user->id);
                $available_serial_no = InventoryEquipmentSerialNo::where('inventory_equipment_id', $existing_equipment->id)->where("deducted", false)->first();
                $order = Order::create([
                    'equipment_assemble_type'   => $equipment_assemble_type,
                    'project_name'              => 'Project ' . $user->id,
                    'user_id'                   => $user->id,
                    'user_address_id'           => UserAddress::where('user_id', $user->id)->first()->id,
                    'date'                      => Carbon::now()->format('Y-m-d'),
                    'order_delivery_upto'       => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
                    'description'               => 'Order description for Equipment ' . $existing_equipment->equipment_name . ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'serial_number'             => $available_serial_no->serial_no,
                    'type_of_equipment'         => 'existing',
                    'existing_equipment'        => $existing_equipment->id,
                    'equipment_name'            => $existing_equipment->equipment_name,
                    'installation_date'         => $faker->randomElement([Carbon::now()->addDays(5), Carbon::now()->addDays(10), Carbon::now()->addDays(15), Carbon::now()->addDays(20)]),
                    'warranty_upto'             => $warranty_upto,
                    'warranty_date'             => $warranty_upto == Carbon::now()->addDays(5) ?: null,
                    'service_contract'          => $faker->randomElement([true, false]),
                    'service_start_date'        => $faker->randomElement([Carbon::now()->addDays(5), Carbon::now()->addDays(10), Carbon::now()->addDays(15), Carbon::now()->addDays(20)]),
                    'service_interval'          => $faker->randomElement(['1', '3', '6', '9', '12']),
                    'quotation_reference'       => 'This section is just for reference of ' . $existing_equipment->equipment_name,
                    'remarks'                   => 'This section is just for remark of ' . $existing_equipment->equipment_name
                ]);
                $parts = InventoryEquipmentPart::where("inventory_equipment_id", $existing_equipment->id)->get();
                foreach ($parts as $part) {

                    $quantity   = Part::find($part->part_id)->quantity;
                    $order_part = OrderPart::create([
                        'order_id'                  => $order->id,
                        'part_id'                   => $part->part_id,
                        'quantity'                  => $part->quantity,
                        'available'                 => $part->quantity < $quantity ? true : false
                    ]);

                    InventoryEquipmentSerialNo::find($available_serial_no->id)->update(['deducted' => true]);
                }
            } else {
                $order = Order::create([
                    'equipment_assemble_type'   => $equipment_assemble_type,
                    'project_name'              => 'Project ' . $user->id,
                    'user_id'                   => $user->id,
                    'user_address_id'           => UserAddress::where('user_id', $user->id)->first()->id,
                    'date'                      => Carbon::now()->format('Y-m-d'),
                    'order_delivery_upto'       => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8']),
                    'description'               => 'Order description for Project ' . $user->id . ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'equipment_name'            => $faker->randomElement(['Mitsubishi Heat Pump (GHP)', 'Vanward Heat Pump (GHP)', 'Chigo Heat Pump (GHP)', 'Haier Heat Pump (GHP)', 'Midea Heat Pump (GHP)', 'Gree Heat Pump (GHP)', 'Phnix Heat Pump (GHP)']),
                    'installation_date'         => $faker->randomElement([Carbon::now()->addDays(5), Carbon::now()->addDays(10), Carbon::now()->addDays(15), Carbon::now()->addDays(20)]),
                    'warranty_upto'             => $warranty_upto,
                    'warranty_date'             => $warranty_upto == Carbon::now()->addDays(5) ?: null,
                    'service_contract'          => $faker->randomElement([true, false]),
                    'service_start_date'        => $faker->randomElement([Carbon::now()->addDays(5), Carbon::now()->addDays(10), Carbon::now()->addDays(15), Carbon::now()->addDays(20)]),
                    'service_interval'          => $faker->randomElement(['1', '3', '6', '9', '12']),
                ]);
                Order::find($order->id)->update(['serial_number' => null, 'quotation_reference' => 'This section is just for reference of ' . $order->equipment_name, 'remarks' => 'This section is just for remark of ' . $order->equipment_name]);

                $parts = Part::inRandomOrder()->limit(5)->get();
                foreach ($parts as $part) {
                    OrderPart::create([
                        'order_id'                  => $order->id,
                        'part_id'                   => $part->id,
                        'quantity'                  => 1,
                    ]);
                }

                $serial_no = PartSerialNo::where("part_id", $part->id)->where("deducted", false)->where("replaced", false)->first();
                PartSerialNo::where("part_id", $serial_no->id)->update(['deducted' => true, 'order_id' => $order->id]);
            }



            OrderImage::create([
                'order_id'                  => $order->id,
                'name'                      => '1.png',
            ]);
            OrderImage::create([
                'order_id'                  => $order->id,
                'name'                      => '2.png',
            ]);
            OrderImage::create([
                'order_id'                  => $order->id,
                'name'                      => '3.png',
            ]);
            OrderDocument::create([
                'order_id'                  => $order->id,
                'name'                      => '1.pdf',
            ]);

            OrderDocument::create([
                'order_id'                  => $order->id,
                'name'                      => '2.pdf',
            ]);



            OrderHistory::create([
                'order_id'                  => $order->id,
                'comment'                      => 'Order #' . $order->id . ' has been generated!',
                'status'                       => 'pending'
            ]);

            OrderHistory::create([
                'order_id'                  => $order->id,
                'comment'                      => 'Order #' . $order->id .  ' has been processed!',
                'status'                       => 'processed'
            ]);
        }
    }
}
