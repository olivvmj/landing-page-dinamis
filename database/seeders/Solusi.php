<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Solusi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            [
                'judul' => 'MENJADI SOLUSI UNTUK',
                'subjudul' => 'SISTEM PARKIRAN',
                'image' => '20230729041319.png',
                'solusi' => 'OFFSTREET',
                'desk_solusi' => 'Pengelolaan parkir dalam area/Kawasan tanpa menggunakan barrier gate.'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'solusi' => 'ONSTREET',
                'desk_solusi' => 'Pengelolaan parkir di ruang terbuka.'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'solusi' => '',
                'desk_solusi' => 'Retribusi Parkir  untuk Pemerintahan Kabupaten/Kota.'
            ]
        ];

        DB::table('solusi_parkirkan')->insert($item);
    }
}
