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
        Permission::findOrCreate('pasiens.view-any');
        Permission::findOrCreate('pasiens.create-any');
        Permission::findOrCreate('pasiens.update-any');
        Permission::findOrCreate('pasiens.delete-any');
        Permission::findOrCreate('pembayarans.view-any');
        Permission::findOrCreate('pembayarans.create-any');
        Permission::findOrCreate('pembayarans.update-any');
        Permission::findOrCreate('pembayarans.delete-any');

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
            'pasiens.view-any',
            'pasiens.create-any',
            'pasiens.update-any',
            'pasiens.delete-any',
            'pembayarans.view-any',
            'pembayarans.create-any',
            'pembayarans.update-any',
            'pembayarans.delete-any',
        ];
        $admin = Role::findOrCreate('admin')
            ->givePermissionTo($adminPermission);
        
        
        $staffPermission = [
            'polis.view-any',
            'dokters.view-any',
            'pasiens.view-any',
            'pembayarans.view-any',
        ];
        
        $staff = Role::findOrCreate('staff')
            ->givePermissionTo($staffPermission);
    }
}
