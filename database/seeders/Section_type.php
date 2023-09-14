<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Section_type extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            [
                'type_name' => 'Banner',
            ],
            [
                'type_name' => 'Card',
            ],
            [
                'type_name' => 'Content',
            ],
            [
                'type_name' => 'Contact',
            ],
        ];

        DB::table('section_type')->insert($item);
    }
}
