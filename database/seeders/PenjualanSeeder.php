<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penjualanData = [
            ['user_id' => 3, 'pembeli' => 'Andi', 'penjualan_kode' => 'PJ-001', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Budi', 'penjualan_kode' => 'PJ-002', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Citra', 'penjualan_kode' => 'PJ-003', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Dewi', 'penjualan_kode' => 'PJ-004', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Eka', 'penjualan_kode' => 'PJ-005', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Fajar', 'penjualan_kode' => 'PJ-006', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Gita', 'penjualan_kode' => 'PJ-007', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Hadi', 'penjualan_kode' => 'PJ-008', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Indra', 'penjualan_kode' => 'PJ-009', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
            ['user_id' => 3, 'pembeli' => 'Joko', 'penjualan_kode' => 'PJ-010', 'penjualan_tanggal' => Carbon::now()->subDays(rand(1, 30))],
        ];

        DB::table('t_penjualan')->insert($penjualanData);
    }
}
