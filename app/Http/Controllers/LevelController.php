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
    

}
