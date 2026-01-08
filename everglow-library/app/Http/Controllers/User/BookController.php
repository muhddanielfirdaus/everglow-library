<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // 📚 SHOW ALL BOOKS (USER VIEW)
    public function index()
    {
        $books = DB::table('books')
            ->where('status', 'Active') // only active books
            ->get();

        return view('user.books.index', compact('books'));
    }

    // 📖 SHOW SINGLE BOOK DETAILS
    public function show($id)
    {
        $book = DB::table('books')
            ->where('id', $id)
            ->where('status', 'Active')
            ->first();

        if (!$book) {
            abort(404);
        }

        return view('user.books.show', compact('book'));
    }
}
