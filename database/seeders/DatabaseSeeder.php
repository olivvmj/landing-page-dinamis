<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Admin::class);
        $this->call(About::class);
        $this->call(Manfaat::class);
        $this->call(Solusi::class);
        $this->call(Fitur::class);
    }
}
