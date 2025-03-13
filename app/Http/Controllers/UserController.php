<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    
    
    // Akses UserModel
    public function index() {
      
        // Insert Data dengan Eloquent Model
       /* $data = [
            'username' => 'customer-1',
            'nama' => 'Pelanggan',
            'password' => Hash::make('12345'),
            'level_id' => 4
        ];
        UserModel::insert($data); // tambah data ke tabel m_user
        */

        // Akses userModel/view
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}
