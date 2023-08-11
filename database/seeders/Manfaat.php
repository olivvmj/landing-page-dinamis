<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Manfaat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            [
                'judul' => 'MANFAAT',
                'subjudul' => 'UNTUK PENGELOLA PARKIR',
                'image' => '20230729060717.png',
                'manfaat' => 'Tidak memerlukan barrier gate'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'manfaat' => 'Waktu masuk dan keluar tercatat by system'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'manfaat' => 'Manajemen Inventory / kapasitas slot parkir'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'manfaat' => 'Metode pembayaran  Tunai / Non Tunai'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '',
                'manfaat' => 'Model tarif yang sangat fleksibel'
            ]
        ];

        DB::table('manfaat_parkirkan')->insert($item);
    }
}
