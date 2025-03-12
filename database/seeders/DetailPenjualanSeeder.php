<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua penjualan yang ada
        $penjualan = DB::table('t_penjualan')->get();
        $barang = DB::table('m_barang')->get();

        $detailData = [];

        foreach ($penjualan as $jual) {
            // Tentukan jumlah barang yang dibeli (1-3 item per transaksi)
            $jumlahBarang = rand(1, 3);
            $barangDipilih = $barang->random($jumlahBarang);

            foreach ($barangDipilih as $item) {
                $detailData[] = [
                    'penjualan_id' => $jual->penjualan_id,
                    'barang_id' => $item->barang_id,
                    'harga' => $item->harga_jual,
                    'jumlah' => rand(1, 5), // Setiap barang dibeli 1-5 pcs
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // Insert ke tabel t_penjualan_detail
        DB::table('t_penjualan_detail')->insert($detailData);
    }
}
