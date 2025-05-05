<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        $activeMenu = 'dashboard';

        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        

        return view('welcome', compact('user','breadcrumb', 'activeMenu'));
    }
}
