<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KSM004',
                'kategori_nama' => 'Kosmetik',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'ALP005',
                'kategori_nama' => 'Alat Tulis',
            ]
        ];
        DB::table('m_kategori')->insert($data);
    }
}
