<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(SupplierSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(PermissionSeeder::class);
        /*$this->call(PartSeeder::class);
        $this->call(InventoryEquipmentSeeder::class);
        $this->call(DefaultSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PurchaseOrderSeeder::class);
        $this->call(EquipmentSeeder::class);*/
        $this->call(TechnicianSeeder::class);
        $this->call(JobSeeder::class);
    }
}
