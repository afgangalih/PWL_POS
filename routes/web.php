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

    // Show
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);



    Route::get('/{id}', [UserController::class, 'show'])
    ->name('user.show'); // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update'); // Menyimpan perubahan data user
    
    // Ajax Edit
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data Ajax

    // Ajax Delete
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // halaman form confirm delete
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // hapus data user ajax


    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Menghapus data user
});

//route CRUD level
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal level
    Route::post("/list", [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']); // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']); // menyimpan data level baru

    // Create dengan ajax
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data level baru ajax

    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);

    Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']); // menyimpan perubahan data level

    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit level ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax

    // Delete dengan ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); //menampilkan form confirm delete level ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
});



// Kategori Route
Route::group(['prefix' => 'kategori'], function () {
    
    // Halaman Utama & DataTable
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index'); 
    Route::post('/list', [KategoriController::class, 'list'])->name('kategori.list'); 

    // Create (Tambah Data)
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create'); 
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');

    // Create dengan AJAX
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); 
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); 

    // Read (Lihat Data)
    Route::get('/{id}', [KategoriController::class, 'show'])->name('kategori.show');

    // Read dengan AJAX
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);

    // Update (Edit Data)
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');

    // Update dengan AJAX
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
  

    // Delete (Hapus Data)
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Delete dengan AJAX
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); 

});




// Supplier Route
Route::group(['prefix' => 'supplier'], function () {

    // Halaman Utama & DataTable
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index'); 
    Route::post('/list', [SupplierController::class, 'list'])->name('supplier.list'); 

    // Create (Tambah Data)
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create'); 
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');

    // Create dengan ajax
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);

    // Edit & Update dengan ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);

    // Read 
    Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show');

    // Read dengan AJAX
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);

    // Update 
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    // Delete (Hapus Data)
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

     // Delete dengan AJAX
     Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); 
     Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); 

});





Route::prefix('barang')->group(function () {
    // Halaman Utama & DataTable
    Route::get('/', [BarangController::class, 'index'])->name('barang.index'); 
    Route::get('/list', [BarangController::class, 'list'])->name('barang.list'); 

    // Create (Tambah Data)
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create'); 
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');

    // Create dengan ajax
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);

    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);

    // Read (Detail)
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');

    // Read dengan AJAX
    Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);

    // Update (Edit & Simpan Perubahan)
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');

   

    // Delete (Hapus Data)
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

     // Delete dengan ajax
     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
});




