<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index'); // Menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list'])->name('user.list'); // Menampilkan data user dalam JSON untuk datatables
    Route::get('/create', [UserController::class, 'create'])->name('user.create'); // Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store'])->name('user.store'); // Menyimpan data user baru

    // Ajax
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/ajax', [UserController::class, 'store_ajax']);

    Route::get('/{id}', [UserController::class, 'show'])
    ->name('user.show'); // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update'); // Menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Menghapus data user
});

// Level Route
// Route untuk DataTables AJAX
Route::post('/level/list', [LevelController::class, 'list'])->name('level.list');

// Route untuk CRUD Level (sudah mencakup index, create, store, show, edit, update, destroy)
Route::resource('level', LevelController::class);


// Kategori Route
Route::resource('kategori', KategoriController::class);
Route::post('kategori/list', [KategoriController::class, 'list'])->name('kategori.list');


// Supplier Route
Route::resource('supplier', SupplierController::class);
Route::post('supplier/list', [SupplierController::class, 'list'])->name('supplier.list');
Route::resource('supplier', SupplierController::class);
Route::post('supplier/list', [SupplierController::class, 'list'])->name('supplier.list');




Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index'); // Tampilkan halaman barang
    Route::get('/list', [BarangController::class, 'list'])->name('barang.list'); // DataTables AJAX
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create'); // Form tambah
    Route::post('/store', [BarangController::class, 'store'])->name('barang.store'); // Simpan data
    Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit'); // Form edit
    Route::put('/update/{id}', [BarangController::class, 'update'])->name('barang.update'); // Simpan perubahan
    Route::delete('/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Hapus data
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show'); // Detail barang
});



