<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('superadminpassword'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('adminpassword'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@mail.com',
                'password' => Hash::make('johndoepassword'),
            ]
        ]);
    }
}
