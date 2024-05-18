<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Atasan 1 User',
                'email' => 'atasan1@gmail.com',
                'password' => Hash::make('atasan123'),
                'role' => 'atasan1',
            ],
            [
                'name' => 'Atasan 2 User',
                'email' => 'atasan2@gmail.com',
                'password' => Hash::make('atasan2123'),
                'role' => 'atasan2',
            ],
        ]);
    }
}
