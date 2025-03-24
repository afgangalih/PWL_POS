<?php

namespace App\Http\Controllers;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level'],
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem',
        ];

        $activeMenu = 'level';

        $level = LevelModel::all(); // ambil semua data level

        return view('level.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'level' => $level]);
    }

    
    
    
       // Ambil data level dalam bentuk json untuk datatables
       public function list(Request $request)
       {
           $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');
   
           if ($request->level_id) {
               $levels->where('level_id', $request->level_id);
           }
   
           return DataTables::of($levels)
               ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
               ->addColumn('aksi', function ($level) {
                   // menambahkan kolom aksi
                   // $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                   // $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                   // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                   //     . csrf_field() . method_field('DELETE') .
                   //     '<button type="submit" class="btn btn-danger btn-sm"
                   //     onclick="return confirm(\'Apakah Anda yakit menghapus data
                   //     ini?\');">Hapus</button></form>';
                   $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
   
                   $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
   
                   $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                   return $btn;
               })
               ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
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

public function show_ajax($id)
{
    $user = UserModel::with('level')->find($id); // Cari User berdasarkan ID

    if (!$user) {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    return view('user.show_ajax', compact('user'));
}

  // Create ajax
  public function create_ajax()
  {
      return view('level.create_ajax');
  }

     // Store ajax
     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'level_kode' => 'required|string|max:5',
                 'level_nama' => 'required|string|max:100',
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             LevelModel::create($request->all());
 
             return response()->json([
                 'status' => true,
                 'message' => 'Data level berhasil disimpan',
             ]);
         }
         return redirect('/');
     }

    // Edit ajax
    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);

        return view('level.edit_ajax', ['level' => $level]);
    }

    // Update ajax
    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:5',
                'level_nama' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = LevelModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

     // Confirm ajax
     public function confirm_ajax(string $id)
     {
         $level = LevelModel::find($id);
 
         return view('level.confirm_ajax', ['level' => $level]);
     }

     // Delete ajax
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    

     
     
    

}
