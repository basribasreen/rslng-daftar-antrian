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
        Permission::findOrCreate('polis.view-any');
        Permission::findOrCreate('polis.create-any');
        Permission::findOrCreate('polis.update-any');
        Permission::findOrCreate('polis.delete-any');
        Permission::findOrCreate('dokters.view-any');
        Permission::findOrCreate('dokters.create-any');
        Permission::findOrCreate('dokters.update-any');
        Permission::findOrCreate('dokters.delete-any');

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $adminPermission = [
            'polis.view-any',
            'polis.create-any',
            'polis.update-any',
            'polis.delete-any',
            'dokters.view-any',
            'dokters.create-any',
            'dokters.update-any',
            'dokters.delete-any',
        ];
        $admin = Role::findOrCreate('admin')
            ->givePermissionTo($adminPermission);
        
        
        $staffPermission = [
            'polis.view-any',
            'dokters.view-any',
        ];
        
        $staff = Role::findOrCreate('staff')
            ->givePermissionTo($staffPermission);
    }
}
