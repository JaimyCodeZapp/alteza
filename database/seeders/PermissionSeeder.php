<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermission = Permission::create([ 'name' => 'admin']);

        $readUsers = Permission::create([ 'name' => 'read_users']);
        $editUsers = Permission::create([ 'name' => 'edit_users']);

        $readRoles = Permission::create([ 'name' => 'read_roles']);
        $editRoles = Permission::create([ 'name' => 'edit_roles']);

        $readPermissions = Permission::create([ 'name' => 'read_permissions']);
        $editPermissions = Permission::create([ 'name' => 'edit_permissions']);

        $readProducts = Permission::create([ 'name' => 'read_products']);
        $editProducts = Permission::create([ 'name' => 'edit_products']);

        $superAdmin = Role::where('name', 'superAdmin')->first();
        $superAdmin->permissions()->sync([
            $adminPermission->id,
            $readUsers->id,
            $editUsers->id,
            $readRoles->id,
            $editRoles->id,
            $readPermissions->id,
            $editPermissions->id,
            $readProducts->id,
            $editProducts->id
        ]);
        $superAdmin->save(); 

        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->sync([
            $adminPermission->id,
            $readUsers->id,
            $readRoles->id,
            $readPermissions->id,
            $readProducts->id
        ]);
        $admin->save(); 
    }
}
