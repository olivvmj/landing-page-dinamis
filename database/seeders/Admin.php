<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            'id' => '',
            'name' => 'Admin Parkirkan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => '',
        ];

        DB::table('users')->insert($item);
    }
}
