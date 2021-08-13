<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermmsionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear cached Premmsions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Premmsions

        Permission::create(['name' => 'qualification read', 'guard_name' => 'admin']);
        Permission::create(['name' => 'qualification update', 'guard_name' => 'admin']);
        Permission::create(['name' => 'qualification create', 'guard_name' => 'admin']);
        Permission::create(['name' => 'qualification delete', 'guard_name' => 'admin']);

        Permission::create(['name' => 'job_role read', 'guard_name' => 'admin']);
        Permission::create(['name' => 'job_role update', 'guard_name' => 'admin']);
        Permission::create(['name' => 'job_role create', 'guard_name' => 'admin']);
        Permission::create(['name' => 'job_role delete', 'guard_name' => 'admin']);

        Permission::create(['name' => 'user read' , 'guard_name' => 'admin']);
        Permission::create(['name' => 'user show' , 'guard_name' => 'admin']);

        // Create Roles
        Role::create(['name' => 'super-admin' , 'guard_name' => 'admin'])
            ->givePermissionTo(Permission::all());
        Role::create(['name' => 'admin' ,  'guard_name' => 'admin']);
        



    }
}
