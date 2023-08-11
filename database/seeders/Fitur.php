<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Fitur extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            [
                'judul' => 'FITUR-FITUR',
                'subjudul' => 'PARKIRKAN',
                'image' => '20230729083742.png',
                'fitur' => 'Pengaturan Tarif',
                'desk_fitur' => 'Anda bisa melakukan pengaturan tarif yang beragam, Bisa diatur sesuai kebutuhan Anda'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '20230729083742.png',
                'fitur' => 'Pengaturan Petugas Parkir',
                'desk_fitur' => 'Punya banyak pegawai? Di PARKIRKAN anda juga dapat mengelola petugas parkir'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '20230729083742.png',
                'fitur' => 'Scan Plat Nomor Kendaraan',
                'desk_fitur' => 'Input plat nomor kendaraan jadi lebih mudah tidak perlu mengetik nomor plat secara manual.'
            ],
            [
                'judul' => '',
                'subjudul' => '',
                'image' => '20230729083742.png',
                'fitur' => 'Slot Penitipan Barang',
                'desk_fitur' => 'Punya slot penitipan barang? Anda bisa mengelolanya di PARKIRKAN, bahkan bisa mengatur tarifnya. '
            ],
        ];

        DB::table('fitur_parkirkan')->insert($item);
    }
}
