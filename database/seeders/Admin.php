<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            'name' => 'Admin Parkirkan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => '',
        ];

        DB::table('users')->insert($item);
    }
}
