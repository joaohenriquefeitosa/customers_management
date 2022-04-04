<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $operational = Role::create(['name' => 'operational']);

        $admin = Role::create(['name' => 'admin']);

        // Groups
        Permission::create(['name' => 'store group']);
        Permission::create(['name' => 'delete group']);
        Permission::create(['name' => 'update group']);
        Permission::create(['name' => 'view group']);

        $operational->givePermissionTo([
            'view group'
        ]);

        $admin->givePermissionTo([
            'store group',
            'update group',
            'delete group',
            'view group'
        ]);

        // Clients
        Permission::create(['name' => 'store client']);
        Permission::create(['name' => 'delete client']);
        Permission::create(['name' => 'update client']);
        Permission::create(['name' => 'view client']);

        $operational->givePermissionTo([
            'store client',
            'update client',
            'delete client',
            'view client'
        ]);

        $admin->givePermissionTo([
            'store client',
            'update client',
            'delete client',
            'view client'
        ]);
    }
}
