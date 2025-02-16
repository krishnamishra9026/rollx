<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seeds the roles table with three roles: Administrator, Content Manager, and Staff.
     *
     * @return void
     */

    public function run(): void
    {

        Role::query()->delete();
        
        Role::create(['name' => 'Administrator', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Sales', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Operations', 'guard_name' => 'administrator']);

        Role::create(['name' => 'Warehouse', 'guard_name' => 'administrator']);
    }
}
