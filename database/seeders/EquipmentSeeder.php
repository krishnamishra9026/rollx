<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\PartSerialNo;
use App\Models\PurchaseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $orders = Order::where('equipment_assemble_type', 'inventory')->inRandomOrder()
            ->limit(40)
            ->get();

        foreach ($orders as $order) {
            Order::where('id', $order->id)->update(['status' => 'completed']);

            OrderHistory::create([
                'order_id' => $order->id,
                'status'   => 'completed',
                'comment'  => 'Order #' . $order->id . ' has been marked completed by the administrator!'
            ]);

            $equipment = Equipment::create([
                'serial_number'             => $order->serial_number,
                'supplier_id'               => 1,
                'user_id'                   => $order->user_id,
                'order_id'                  => $order->id,
                'user_address_id'           => $order->user_address_id,
                'equipment_assemble_type'   => 'inventory',
                'equipment_name'            => $order->equipment_name,
                'installation_date'         => $order->installation_date,
                'warranty_upto'             => $order->warranty_upto,
                'warranty_date'             => $order->warranty_date,
                'service_contract'          => $order->service_contract,
                'service_start_date'        => $order->service_start_date,
                'service_interval'          => $order->service_interval,
                'status'                    => 1,
                'quotation_reference'        => $order->quotation_reference,
                'remarks'                    => $order->remarks,
            ]);

            $part_serial_nos = PartSerialNo::where("order_id", $order->id)->where("deducted", true)->where("replaced", false)->get();

            foreach ($part_serial_nos as $key => $sno) {
                $sno->update(['equipment_id' => $equipment->id, "deducted" => true]);
            }

            foreach($order->parts as $part){
                $order_part = EquipmentPart::create([
                    'equipment_id'              => $equipment->id,
                    'part_id'                   => $part->part_id,
                    'quantity'                  => $part->quantity,
                    'installation_date'         => $part->part_installation_date,
                    'warranty_upto'             => $part->part_warranty_upto,
                    'replace'                   => false
                ]);
            }
        }

        // $purchase_orders = PurchaseOrder::get();

        // foreach ($purchase_orders as $order) {
        //     Order::where('id', $order->order_id)->update(['status' => 'completed']);
        //     PurchaseOrder::where('order_id', $order->order_id)->update(['status' => 'completed']);
        //     OrderHistory::create([
        //         'order_id' => $order->order_id,
        //         'status'   => 'completed',
        //         'comment'  => 'Purchase Order for Order #' . $order->order_id . ' has been marked completed by the administrator!'
        //     ]);

        //     OrderHistory::create([
        //         'order_id' => $order->order_id,
        //         'status'   => 'completed',
        //         'comment'  => 'Order #' . $order->order_id . ' has been marked completed by the administrator!'
        //     ]);

        //     $equipment = Equipment::create([
        //         'serial_number'             => $order->order->serial_number,
        //         'supplier_id'               => 1,
        //         'user_id'                   => $order->order->user_id,
        //         'order_id'                  => $order->order->id,
        //         'user_address_id'           => $order->order->user_address_id,
        //         'equipment_assemble_type'   => 'supplier',
        //         'equipment_name'            => $order->order->equipment_name,
        //         'installation_date'         => $order->order->installation_date,
        //         'warranty_upto'             => $order->order->warranty_upto,
        //         'warranty_date'             => $order->order->warranty_date,
        //         'service_contract'          => $order->order->service_contract,
        //         'service_start_date'        => $order->order->service_start_date,
        //         'service_interval'          => $order->order->service_interval,
        //         'status'                    => 1,
        //         'quotation_reference'        => $order->order->quotation_reference,
        //         'remarks'                    => $order->order->remarks,
        //     ]);

        //     foreach($order->order->parts as $part){
        //         $order_part = EquipmentPart::create([
        //             'equipment_id'              => $equipment->id,
        //             'part_id'                   => $part->part_id,
        //             'quantity'                  => $part->quantity,
        //             'installation_date'         => $part->installation_date,
        //             'warranty_upto'             => $part->warranty_upto,
        //             'replace'                   => false
        //         ]);
        //     }
        // }
    }
}
