<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('tahapan')->insert([
                [
                    'nama_tahapan' => 'stimulasi',
                    'urutan' => 1
                ],
                [
                    'nama_tahapan' => 'identifikasi-masalah',
                    'urutan' => 2
                ],
                [
                    'nama_tahapan' => 'pengumpulan-data',
                    'urutan' => 3
                ],
                [
                    'nama_tahapan' => 'pengolahan-data',
                    'urutan' => 4
                ],
                [
                    'nama_tahapan' => 'verifikasi',
                    'urutan' => 5
                ],
                [
                    'nama_tahapan' => 'generalization',
                    'urutan' => 6
                ]
            ]);
    }
}
