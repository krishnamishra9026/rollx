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
        $this->call(FranchiseSeeder::class);
        $this->call(ChefSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
