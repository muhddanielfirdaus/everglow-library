<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BorrowRecordController extends Controller
{
    public function index()
    {
        $records = DB::table('borrowings')
            ->join('users','borrowings.user_id','=','users.id')
            ->join('books','borrowings.book_id','=','books.id')
            ->select(
                'borrowings.*',
                'users.name as username',
                'books.title as booktitle'
            )
            ->orderBy('borrowings.created_at','desc')
            ->get();

        return view('admin.borrow-records', compact('records'));
    }
}
