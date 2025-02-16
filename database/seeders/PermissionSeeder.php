<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->delete();

        // Products Permissions
        $permission_1 = Permission::create(['guard_name' => 'administrator', 'name' => 'Products']);
        $permission_2 = Permission::create(['guard_name' => 'administrator', 'name' => 'View Product']);
        $permission_3 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Product']);
        $permission_4 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Product']);
        $permission_5 = Permission::create(['guard_name' => 'administrator', 'name' => 'Filter Products']);


        // Leads Permissions
        $permission_6 = Permission::create(['guard_name' => 'administrator', 'name' => 'Leads']);
        $permission_7 = Permission::create(['guard_name' => 'administrator', 'name' => 'Add Lead']);
        $permission_8 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Lead']);
        $permission_9 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Lead']);
        $permission_10 = Permission::create(['guard_name' => 'administrator', 'name' => 'View Leads']);
        
        //$permission_10 = Permission::create(['guard_name' => 'administrator', 'name' => 'Convert Leads']);


        // Order Permissions
        $permission_11 = Permission::create(['guard_name' => 'administrator', 'name' => 'Orders']);
        $permission_12 = Permission::create(['guard_name' => 'administrator', 'name' => 'View Order']);
        $permission_13 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Order']);
        $permission_14 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Order']);
        $permission_15 = Permission::create(['guard_name' => 'administrator', 'name' => 'Filter Orders']);


        // Franchises Permissions
        $permission_16 = Permission::create(['guard_name' => 'administrator', 'name' => 'Franchisess']);
        $permission_17 = Permission::create(['guard_name' => 'administrator', 'name' => 'View Franchises']);
        $permission_18 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Franchises']);
        $permission_19 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Franchises']);
        $permission_20 = Permission::create(['guard_name' => 'administrator', 'name' => 'Filter Franchisess']);


        // Tickets Permissions
        $permission_21 = Permission::create(['guard_name' => 'administrator', 'name' => 'Tickets']);
        $permission_22 = Permission::create(['guard_name' => 'administrator', 'name' => 'Create Ticket']);
        $permission_23 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Ticket']);
        $permission_24 = Permission::create(['guard_name' => 'administrator', 'name' => 'Show Ticket']);
        $permission_25 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Ticket']);
        $permission_26 = Permission::create(['guard_name' => 'administrator', 'name' => 'Chat']);

        // Users Permissions
        $permission_27 = Permission::create(['guard_name' => 'administrator', 'name' => 'Users']);
        $permission_28 = Permission::create(['guard_name' => 'administrator', 'name' => 'View User']);
        $permission_29 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit User']);
        $permission_30 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete User']);
        $permission_31 = Permission::create(['guard_name' => 'administrator', 'name' => 'Create User']);

        // Role Permissions
        $permission_32 = Permission::create(['guard_name' => 'administrator', 'name' => 'Roles']);
        $permission_33 = Permission::create(['guard_name' => 'administrator', 'name' => 'View Role']);
        $permission_34 = Permission::create(['guard_name' => 'administrator', 'name' => 'Edit Role']);
        $permission_35 = Permission::create(['guard_name' => 'administrator', 'name' => 'Delete Role']);
        $permission_36 = Permission::create(['guard_name' => 'administrator', 'name' => 'Create Role']);


        // Settings Permissions
        $permission_37 = Permission::create(['guard_name' => 'administrator', 'name' => 'Settings']);
        $permission_38 = Permission::create(['guard_name' => 'administrator', 'name' => 'My Account']);
        $permission_39 = Permission::create(['guard_name' => 'administrator', 'name' => 'Change Password']);
        $permission_40 = Permission::create(['guard_name' => 'administrator', 'name' => 'General Settings']);

        $permissions = Permission::all();

        $admin_role       = Role::where('name', 'Administrator')->first();
        $admin_role->syncPermissions($permissions);

        $staff_role       = Role::where('name', 'Sales')->first();                    
              
        $staff_role->syncPermissions($permissions);

        $content_manager       = Role::where('name', 'Operations')->first();
        $content_manager->syncPermissions($permissions);

        $content_manager       = Role::where('name', 'Warehouse')->first();
        $content_manager->syncPermissions($permissions);
    }
}
