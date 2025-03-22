<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];
        
        $activeMenu = 'supplier';
        
        return view('supplier.index', compact('breadcrumb', 'activeMenu'));
    }

    public function list()
    {
        $suppliers = DB::table('m_supplier')->get();

        return DataTables::of($suppliers)
            ->addColumn('action', function($supplier){
                return '
                    <a href="'.route('supplier.show', $supplier->supplier_id).'" class="btn btn-info btn-sm">Detail</a>
                    <a href="'.route('supplier.edit', $supplier->supplier_id).'" class="btn btn-warning btn-sm">Edit</a>
                    <form action="'.route('supplier.destroy', $supplier->supplier_id).'" method="POST" class="d-inline">
                        '.csrf_field().method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus data ini?\')">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
{
    return view('supplier.create', [
        'breadcrumb' => (object)[
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ],
        'activeMenu' => 'supplier'
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'supplier_kode' => 'required|unique:m_supplier,supplier_kode|max:10',
        'supplier_name' => 'required|max:100',
        'supplier_alamat' => 'nullable|max:255'
    ]);

    DB::table('m_supplier')->insert([
        'supplier_kode' => $request->supplier_kode,
        'supplier_name' => $request->supplier_name,
        'supplier_alamat' => $request->supplier_alamat,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
}

public function show($id)
{
    $supplier = DB::table('m_supplier')->where('supplier_id', $id)->first();

    if (!$supplier) {
        return redirect()->route('supplier.index')->with('error', 'Supplier tidak ditemukan.');
    }

    $breadcrumb = (object) [
        'title' => 'Detail Supplier',
        'list' => ['Home', 'Supplier', 'Detail']
    ];
    
    $activeMenu = 'supplier';

    return view('supplier.show', compact('supplier', 'breadcrumb', 'activeMenu'));
}


public function edit($id)
{
    $supplier = DB::table('m_supplier')->where('supplier_id', $id)->first();

    if (!$supplier) {
        return redirect()->route('supplier.index')->with('error', 'Supplier tidak ditemukan.');
    }

    $breadcrumb = (object) [
        'title' => 'Edit Supplier',
        'list' => ['Home', 'Supplier', 'Edit']
    ];

    $activeMenu = 'supplier';

    return view('supplier.edit', compact('supplier', 'activeMenu', 'breadcrumb'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'supplier_kode' => 'required|max:10|unique:m_supplier,supplier_kode,'.$id.',supplier_id',
        'supplier_name' => 'required|max:100',
        'supplier_alamat' => 'nullable|max:255'
    ]);

    DB::table('m_supplier')->where('supplier_id', $id)->update([
        'supplier_kode' => $request->supplier_kode,
        'supplier_name' => $request->supplier_name,
        'supplier_alamat' => $request->supplier_alamat,
        'updated_at' => now()
    ]);

    return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
}

public function destroy($id)
{
    DB::table('m_supplier')->where('supplier_id', $id)->delete();

    return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
}

}
