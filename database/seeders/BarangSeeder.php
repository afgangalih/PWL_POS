<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Supplier 1
            [
                'kategori_id' => 1,
                'barang_kode' => 'ELK001-01',
                'barang_nama' => 'Laptop ASUS',
                'harga_beli' => 7000000,
                'harga_jual' => 7500000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'ELK001-02',
                'barang_nama' => 'Smartphone Samsung',
                'harga_beli' => 4000000,
                'harga_jual' => 4500000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'ELK001-03',
                'barang_nama' => 'Headset Sony',
                'harga_beli' => 500000,
                'harga_jual' => 600000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'ELK001-04',
                'barang_nama' => 'Smartwatch Xiaomi',
                'harga_beli' => 900000,
                'harga_jual' => 1000000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'ELK001-05',
                'barang_nama' => 'Power Bank Anker',
                'harga_beli' => 300000,
                'harga_jual' => 350000,
            ],

            // Supplier 2
            [
                'kategori_id' => 2,
                'barang_kode' => 'FAS002-01',
                'barang_nama' => 'Hoodie',
                'harga_beli' => 150000,
                'harga_jual' => 200000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FAS002-02',
                'barang_nama' => 'Sepatu Sneakers',
                'harga_beli' => 250000,
                'harga_jual' => 300000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FAS002-03',
                'barang_nama' => 'Tas Ransel',
                'harga_beli' => 180000,
                'harga_jual' => 220000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FAS002-04',
                'barang_nama' => 'Topi Baseball',
                'harga_beli' => 75000,
                'harga_jual' => 100000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FAS002-05',
                'barang_nama' => 'Kacamata Hitam',
                'harga_beli' => 120000,
                'harga_jual' => 150000,
            ],

            // Supplier 3
            [
                'kategori_id' => 3,
                'barang_kode' => 'MKN003-01',
                'barang_nama' => 'Kentang Musthofa',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'MKN003-02',
                'barang_nama' => 'Coklat Batang',
                'harga_beli' => 12000,
                'harga_jual' => 17000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'MKN003-03',
                'barang_nama' => 'Biskuit Gandum',
                'harga_beli' => 15000,
                'harga_jual' => 20000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'MKN003-04',
                'barang_nama' => 'Permen Mint',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'MKN003-05',
                'barang_nama' => 'Madu Murni',
                'harga_beli' => 45000,
                'harga_jual' => 55000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
