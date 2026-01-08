<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // SECURITY CHECK (must login as admin)
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('login')->with('error', 'Please login as admin');
        }

        $username = Session::get('admin_username');

        // ===========================
        // 👇 DISPLAY IMAGE BY USERNAME
        // ===========================
        $picture = 'images/admin.png'; // default admin image

        if (strtoupper($username) === 'MAIZATUL') {
            $picture = 'images/mai.png';
        }
        elseif (strtoupper($username) === 'AIDA IZZATI') {
            $picture = 'images/IZZATI.png';
        }
        elseif (strtoupper($username) === 'ADMIN') {
            $picture = 'images/admin.png';
        }


        // 📊 Dashboard Stats
        $bookCount   = DB::table('books')->count();
        $userCount   = DB::table('users')->count();
        $borrowCount = DB::table('borrowings')->count();

        return view('admin.dashboard', compact(
            'username','picture','bookCount','userCount','borrowCount'
        ));
    }
}
