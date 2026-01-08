<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Total Books in System
        $totalBooks = DB::table('books')->count();

        // Books user has borrowed
        $borrowedBooks = DB::table('borrowings')
            ->where('user_id',$userId)
            ->where('status','Borrowed')
            ->count();

        // Returned Books (dashboard box)
        $returnedBooks = DB::table('borrowings')
            ->where('user_id',$userId)
            ->where('status','Returned')
            ->count();

        // Borrowing Table History
        $borrowings = DB::table('borrowings')
            ->join('books','borrowings.book_id','=','books.id')
            ->where('borrowings.user_id',$userId)
            ->select('books.title','borrowings.borrowed_at','borrowings.returned_at','borrowings.status')
            ->orderBy('borrowings.borrowed_at','desc')
            ->get();

        return view('user.dashboard',compact(
            'totalBooks','borrowedBooks','returnedBooks','borrowings'
        ));
    }
}
