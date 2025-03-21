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
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show'); // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); // Menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update'); // Menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Menghapus data user
});

Route::get('/level', [LevelController::class, 'index'])->name('level.index');
Route::post('/level/list', [LevelController::class, 'list'])->name('level.list');

Route::resource('level', LevelController::class);
Route::post('level/list', [LevelController::class, 'list'])->name('level.list');

// Kategori Route
Route::resource('kategori', KategoriController::class);
Route::post('kategori/list', [KategoriController::class, 'list'])->name('kategori.list');


// Supplier Route
Route::resource('supplier', SupplierController::class);
Route::post('supplier/list', [SupplierController::class, 'list'])->name('supplier.list');


