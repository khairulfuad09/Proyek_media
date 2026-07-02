<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'nis' => 11111111,
                'password' => bcrypt('123456789'),
                'role' => 'admin'
            ],
            [
                'name' => 'Khairul',
                'email' => 'Khairul@gmail.com',
                'nis' => 21111111,
                'password' => bcrypt('123456789'),
                'role' => 'guru'
            ]
        ]);
    }
}
