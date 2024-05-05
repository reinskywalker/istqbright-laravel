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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view site']);
        Permission::create(['name' => 'manage site']);
        Permission::create(['name' => 'manage admins']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo('manage site');

        $role = Role::create(['name' => 'super-admin'])
            ->givePermissionTo('manage admins');

        // or may be done by chaining
        $role1 = Role::create(['name' => 'user'])
            ->givePermissionTo(['view site']);
    }
}
