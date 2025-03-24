<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori'],
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem',
        ];

        $activeMenu = 'kategori';

        $kategori = KategoriModel::all();

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'kategori' => $kategori]);
    }

    

    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        if ($request->kategori_id) {
            $kategori->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                // $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
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

     // Create ajax
     public function create_ajax()
     {
         return view('kategori.create_ajax');
     }

     // Store ajax
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:5',
                'kategori_nama' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

        // Edit ajax
        public function edit_ajax(string $id)
        {
            $kategori = KategoriModel::find($id);
    
            return view('kategori.edit_ajax', ['kategori' => $kategori]);
        }

        // Update ajax
    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:5',
                'kategori_nama' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = KategoriModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data kategori berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kategori tidak ditemukan',
                ]);
            }
        }
        return redirect('/');    
    }

      // Confirm delete
      public function confirm_ajax(string $id)
      {
          $kategori = KategoriModel::find($id);
  
          return view('kategori.confirm_ajax', ['kategori' => $kategori]);
      }
  
      // Delete ajax
      public function delete_ajax(Request $request, string $id)
      {
          if ($request->ajax() || $request->wantsJson()) {
              $kategori = KategoriModel::find($id);
              if ($kategori) {
                  $kategori->delete();
                  return response()->json([
                      'status' => true,
                      'message' => 'Data kategori berhasil dihapus',
                  ]);
              } else {
                  return response()->json([
                      'status' => false,
                      'message' => 'Data kategori tidak ditemukan',
                  ]);
              }
          }
          return redirect('/');
      }

    // Show Ajax
    public function show_ajax($id)
{
    $kategori = KategoriModel::find($id);
    return view('kategori.show_ajax', compact('kategori'));
}

  


}
