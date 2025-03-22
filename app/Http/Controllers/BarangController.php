<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        
        $activeMenu = 'barang';

        return view('barang.index', compact('breadcrumb', 'activeMenu'));
    }

    public function list()
    {
        $barang = DB::table('m_barang')
            ->leftJoin('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id')
            ->select(
                'm_barang.barang_id',
                'm_barang.barang_kode',
                'm_barang.barang_nama',
                'm_kategori.kategori_nama',
                'm_barang.harga_beli',
                'm_barang.harga_jual'
            );
        
        return DataTables::of($barang)
            ->addColumn('aksi', function($row){

                $detailBtn = '<a href="'.route('barang.show', $row->barang_id).'" class="btn btn-sm btn-success">
                <i class="fa fa-eye"></i> Detail
            </a>';

                $editBtn = '<a href="'.route('barang.edit', $row->barang_id).'" class="btn btn-sm btn-info">
                    <i class="fa fa-edit"></i> Edit
                </a>';
                
                $deleteBtn = '<form action="'.route('barang.destroy', $row->barang_id).'" method="POST" 
                    class="d-inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus barang ini?\')">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>';
                
                return $editBtn . ' ' . $deleteBtn. ''.$detailBtn;
            })
            ->rawColumns(['aksi'])  // Penting: agar HTML di kolom aksi dirender dengan benar
            ->make(true);
    }

    public function show($id)
    {
        $barang = DB::table('m_barang')
            ->leftJoin('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id')
            ->select(
                'm_barang.*',
                'm_kategori.kategori_nama'
            )
            ->where('m_barang.barang_id', $id)
            ->first();
        
        if (!$barang) {
            abort(404);
        }

        $activeMenu = 'barang';
        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list'  => ['Barang', 'Detail']
        ];
        
        return view('barang.show', compact('barang', 'activeMenu', 'breadcrumb'));
    }


    public function create()
    {
        $kategori = KategoriModel::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
        ]);

        BarangModel::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = BarangModel::findOrFail($id);
        $kategori = KategoriModel::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
        ]);

        $barang = BarangModel::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        BarangModel::destroy($id);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
