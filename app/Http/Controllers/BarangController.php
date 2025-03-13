<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class BarangController extends Controller
{
    public function index()
    {
        $barang = BarangModel::with('kategori')->get(); // Ambil data barang dengan kategori
        return view('barang', compact('barang'));
    }

    public function create()
    {
        $kategori = KategoriModel::all(); // Ambil semua kategori dari tabel m_kategori
        return view('barang_tambah', compact('kategori'));
    }
    

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
        ]);

        // Simpan ke database
        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }
}
