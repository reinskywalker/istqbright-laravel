<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view site']);
        Permission::create(['name' => 'manage site']);
        Permission::create(['name' => 'manage admins']);

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo('manage site');

        $role = Role::create(['name' => 'super-admin'])
            ->givePermissionTo('manage admins');

        $role1 = Role::create(['name' => 'user'])
            ->givePermissionTo(['view site']);
    }
}
