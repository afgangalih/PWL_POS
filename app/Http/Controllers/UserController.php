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
         
        // 2.2
       /* $user = UserModel::where('username', 'manager9')->firstOrFail(1);
        return view('user', ['data' => $user]); */

      /*  $user = UserModel::where('user_id', 1)->first();
         return view('user', ['data' => $user ? [$user] : []]); */

       /* $user = UserModel::all();
        return view('user', ['data' => $user]); */
       
        //2.3
       /* $jumlah_user = UserModel::where('level_id', 2)->count(); // Hitung jumlah user level 2
        $data = UserModel::where('level_id', 2)->get(); // Ambil data user level 2
    
        return view('user', ['data' => $data, 'jumlah_user' => $jumlah_user]); */

        // 2.4
       /* $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'manager Tiga Tiga',
                'password' => hash::make('12345'),
                'level_id' => 2
             
            ],
        );
        $user->save();
        return view('user', ['data' => $user]); */

        // 2.5
       /* $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);
        
        $user->username = 'manager12';
        
        $user->save();
        
        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        dd($user->wasChanged(['nama', 'username'])); // true */

        // 2.6
       /* $user = UserModel::all();
        return view('user', ['data' => $user]); */

        // 2.7
      $user = UserModel::with('level')->get(); // Fetch all users
         return view('user', ['data' => $user]);
        
    }

    public function tambah () {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request) {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);

        return redirect('/user');
    }

    public function ubah($id) {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan(Request $request, $id) {
        $user = UserModel::findOrFail($id); // Mencari data user berdasarkan ID
        
        // Cek apakah password diubah
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;
        $user->save();
    
        return redirect('/user')->with('success', 'Data berhasil diperbarui!');
    }

    public function hapus($id) {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
    
    
    



}
