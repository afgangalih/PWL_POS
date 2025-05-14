<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = BarangModel::with('kategori')->get();
        return response()->json([
            'success' => true,
            'data' => $barangs
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
            'barang_kode' => ['required', 'min:3', 'max:20', 'unique:m_barang,barang_kode'],
            'barang_nama' => ['required', 'string', 'max:100'],
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/barang', $image->hashName());

        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $image->hashName()
        ]);

        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ], 201);
        }

        return response()->json([
            'success' => false
        ], 409);
    }

    public function show(BarangModel $barang)
    {
        return response()->json([
            'success' => true,
            'data' => $barang->load('kategori')
        ], 200);
    }

    public function update(Request $request, BarangModel $barang)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
            'barang_kode' => ['required', 'min:3', 'max:20', 'unique:m_barang,barang_kode,' . $barang->barang_id . ',barang_id'],
            'barang_nama' => ['required', 'string', 'max:100'],
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ];

        if ($request->hasFile('image')) {
            if ($barang->image) {
                Storage::delete('public/barang/' . $barang->image);
            }
            $image = $request->file('image');
            $image->storeAs('public/barang', $image->hashName());
            $data['image'] = $image->hashName();
        }

        $barang->update($data);

        return response()->json([
            'success' => true,
            'data' => $barang
        ], 200);
    }

    public function destroy(BarangModel $barang)
    {
        if ($barang->image) {
            Storage::delete('public/barang/' . $barang->image);
        }

        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ], 200);
    }
}