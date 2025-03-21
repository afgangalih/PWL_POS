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
}
