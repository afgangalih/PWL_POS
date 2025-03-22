<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index', [
            'activeMenu' => 'kategori',
            'breadcrumb' => (object)[
                'title' => 'Kategori',
                'list' => ['Home', 'Kategori']
            ]
        ]);
    }
    

    public function list()
    {
        $data = DB::table('m_kategori')->get();

        return DataTables::of($data)
            ->addColumn('aksi', function($row){
                return '
                    <a href="'.route('kategori.show', $row->kategori_id).'" class="btn btn-info btn-sm">Detail</a>
                    <a href="'.route('kategori.edit', $row->kategori_id).'" class="btn btn-warning btn-sm">Edit</a>
                    <form action="'.route('kategori.destroy', $row->kategori_id).'" method="POST" class="d-inline">
                        '.csrf_field().method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus data ini?\')">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
{
    return view('kategori.create', [
        'activeMenu' => 'kategori',
        'breadcrumb' => (object)[
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ]
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode',
        'kategori_nama' => 'required|max:100'
    ]);

    DB::table('m_kategori')->insert([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
}

public function show($id)
{
    $kategori = DB::table('m_kategori')->where('kategori_id', $id)->first();
    if (!$kategori) {
        abort(404);
    }

    return view('kategori.show', [
        'activeMenu' => 'kategori',
        'breadcrumb' => (object)[
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ],
        'kategori' => $kategori
    ]);
}

public function edit($id)
{
    $kategori = DB::table('m_kategori')->where('kategori_id', $id)->first();
    if (!$kategori) {
        abort(404);
    }

    return view('kategori.edit', [
        'activeMenu' => 'kategori',
        'breadcrumb' => (object)[
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ],
        'kategori' => $kategori
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
        'kategori_nama' => 'required|max:100'
    ]);

    DB::table('m_kategori')->where('kategori_id', $id)->update([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama,
        'updated_at' => now(),
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
}

public function destroy($id)
{
    DB::table('m_kategori')->where('kategori_id', $id)->delete();
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
}

}
