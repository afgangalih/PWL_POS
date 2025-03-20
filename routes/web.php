<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

// Route Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');


Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');


Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

// 2.6
// Rute User
Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah');

Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan'])->name('user.tambah_simpan');

Route::get('/ubah/{id}', [UserController::class, 'ubah'])->name('user.ubah');
   
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan'])->name('user.ubah_simpan');

Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');

// Jobsheet 3

// Praktikum 2
Route::get('/', [WelcomeController::class, 'index']);

