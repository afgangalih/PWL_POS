<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
  
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_name' => 'CV. Sugeng Jaya',
                'supplier_alamat' => 'Jl. Sudirman No. 45, Malang',
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
