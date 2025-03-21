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
}
