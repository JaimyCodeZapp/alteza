<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([ 'name' => 'superAdmin']);
        $adminRole = Role::create([ 'name' => 'admin']);

        $superAdmin = User::where('name', 'Super Admin')->first();
        $superAdmin->roles()->sync($superAdminRole->id);
        $superAdmin->save(); 

        $admin = User::where('name', 'Admin')->first();
        $admin->roles()->sync($adminRole->id);
        $admin->save(); 
    }
}
