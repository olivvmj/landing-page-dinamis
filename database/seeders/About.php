<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class About extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            'judul' => 'APLIKASI',
            'subjudul' => 'PARKIRKAN',
            'deskripsi' => 'APLIKASI PENGELOLAAN PARKIR YANG MUDAH DAN PRAKTIS. DIBUNDLING DENGAN SMART POS Z90, MEMUNGKINKAN ANDA UNTUK MELAKUKAN SEMUA KEGIATAN PERPARKIRAN HANYA DALAM GENGGAMAN.',
            'image' => '20230811045948.png',
        ];

        DB::table('about_parkirkan')->insert($item);
    }
}
