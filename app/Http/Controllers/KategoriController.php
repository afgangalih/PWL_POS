<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {

       /* $data = [
            'kategori_kode' => 'SNK006',
            'kategori_nama' => 'Snack',
            'created_at' => now()
        ];
        DB::table('m_kategori')->insert($data);
        return 'Insert data baru berhasil!'; */

         /* $row = DB::table('m_kategori')
        ->where('kategori_kode', 'SNK006')
         ->update(['kategori_nama' => 'Camilan']);
         return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris'; */

        /* $row = DB::table('m_kategori')->where('kategori_kode', 'SNK006')->delete();
         return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' Baris'; */

         $data = DB::table('m_kategori')->get();
         return view('kategori', ['data' => $data]);

    }
}
