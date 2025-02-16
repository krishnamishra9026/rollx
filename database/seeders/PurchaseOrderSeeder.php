<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderHistory;
use Carbon\Carbon;
use Faker\Generator;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        for ($i = 1; $i < 41; $i++) {
            $order = PurchaseOrder::create([
                "supplier_id"       => 1,
                "project_reference" => "Project Reference for PO" . $i,
                "model_number"      => "OPO-EQP00-" . $i,
                "quantity"          => 1,
                "remarks"           => "This remark is entered by the administrator for PO" . $i,
                "due_date"          => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
                "order_date"        => Carbon::now()->subDays($i)->format("Y-m-d"),
                "suplier_remarks"   => null,
                "percentage"        => null,
                "status"            => "PO Generated"
            ]);

            PurchaseOrderHistory::create([
                'purchase_order_id' => $order->id,
                'status'   => 'PO Generated',
                'comment'  => 'Purchase Order#'.$order->id.  ' has been generated!',
                'status_changed_by' => 'administrator',
                'status_changer_id' => 2
            ]);
        }
    }
}
