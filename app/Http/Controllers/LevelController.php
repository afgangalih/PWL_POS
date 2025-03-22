<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Level Pengguna',
            'list'  => ['Home' => url('/'), 'Level']
        ];
    
        return view('level.index', [
            'activeMenu' => 'level',
            'breadcrumb' => $breadcrumb
        ]);
    }
    
    
    
    public function list()
    {
        $data = DB::table('m_level')->get();
    
        return DataTables::of($data)
            ->addColumn('aksi', function($row){
                return '
                    <a href="'.route('level.show', $row->level_id).'" class="btn btn-info btn-sm">Detail</a>
                    <a href="'.route('level.edit', $row->level_id).'" class="btn btn-warning btn-sm">Edit</a>
                    <form action="'.route('level.destroy', $row->level_id).'" method="POST" class="d-inline">
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
    $breadcrumb = (object) [
        'title' => 'Tambah Level',
        'list'  => ['Home' => url('/'), 'Level', 'Tambah']
    ];

    return view('level.create', [
        'activeMenu' => 'level',
        'breadcrumb' => $breadcrumb
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'level_kode' => 'required|max:10|unique:m_level,level_kode',
        'level_nama' => 'required|max:100'
    ]);

    DB::table('m_level')->insert([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('level.index')->with('success', 'Level berhasil ditambahkan!');
}

public function show($id)
{
    $level = DB::table('m_level')->where('level_id', $id)->first();

    if (!$level) {
        abort(404);
    }

    $breadcrumb = (object) [
        'title' => 'Detail Level',
        'list'  => ['Home' => url('/'), 'Level', 'Detail']
    ];

    return view('level.show', compact('level', 'breadcrumb'))->with('activeMenu', 'level');
}

public function edit($id)
{
    $level = DB::table('m_level')->where('level_id', $id)->first();

    if (!$level) {
        abort(404);
    }

    $breadcrumb = (object) [
        'title' => 'Edit Level',
        'list'  => ['Home' => url('/'), 'Level', 'Edit']
    ];

    return view('level.edit', compact('level', 'breadcrumb'))->with('activeMenu', 'level');
}

public function update(Request $request, $id)
{
    $request->validate([
        'level_kode' => "required|max:10|unique:m_level,level_kode,$id,level_id",
        'level_nama' => 'required|max:100'
    ]);

    DB::table('m_level')->where('level_id', $id)->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
        'updated_at' => now()
    ]);

    return redirect()->route('level.index')->with('success', 'Level berhasil diperbarui!');
}

public function destroy($id)
{
    DB::table('m_level')->where('level_id', $id)->delete();

    return redirect()->route('level.index')->with('success', 'Level berhasil dihapus!');
}

    

}
