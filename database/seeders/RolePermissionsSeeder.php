<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'polis.view-any']);
        Permission::create(['name' => 'polis.create-any']);
        Permission::create(['name' => 'polis.update-any']);
        Permission::create(['name' => 'polis.delete-any']);

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $adminPermission = [
            'polis.view-any',
            'polis.create-any',
            'polis.update-any',
            'polis.delete-any',
        ];
        $admin = Role::findOrCreate('admin')
            ->givePermissionTo($adminPermission);
        
        
        $staffPermission = [
            'polis.view-any',
        ];
        
        $staff = Role::findOrCreate('staff')
            ->givePermissionTo($staffPermission);
    }
}
