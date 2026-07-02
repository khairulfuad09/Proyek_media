<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materis')->insert([
            [
                'judul' => 'Sistem Koordinasi Manusia',
                'slug' => 'sistem-koordinasi-manusia',
                'deskripsi' => 'Deskripsi materi 1'
            ],
            [
                'judul' => 'Alat Indra Manusia',
                'slug' => 'alat-indra-manusia',
                'deskripsi' => 'Deskripsi materi 2'
            ],
            [
                'judul' => 'Hormon Manusia',
                'slug' => 'hormon-manusia',
                'deskripsi' => 'Deskripsi materi 3'
            ],
            [
                'judul' => 'Homeostasis',
                'slug' => 'homeostasis-manusia',
                'deskripsi' => 'Deskripsi materi 4'
            ]
        ]);

    }
}
