<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $activeMenu = 'dashboard';

        // Tambahkan breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        return view('dashboard', compact('user', 'activeMenu', 'breadcrumb'));
    }
}

