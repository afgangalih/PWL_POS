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

        /* $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];
        UserModel::create($data); */

       /* $user = UserModel::find(1);
        return view('user', ['data' => $user]); */

        $user = UserModel::where('username', 'manager9')->firstOrFail(1);
        return view('user', ['data' => $user]);

      /*  $user = UserModel::where('user_id', 1)->first();
         return view('user', ['data' => $user ? [$user] : []]); */

       /* $user = UserModel::all();
        return view('user', ['data' => $user]); */
    }
}
