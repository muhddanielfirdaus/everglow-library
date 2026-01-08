<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuditLogger;

class BorrowingController extends Controller
{
    // 📄 User Borrow List
    public function index()
    {
        $borrowings = DB::table('borrowings')
            ->join('books','borrowings.book_id','=','books.id')
            ->select('borrowings.id','books.title','books.author','borrowings.borrowed_at','borrowings.status','borrowings.returned_at')
            ->where('borrowings.user_id',auth()->id())
            ->orderBy('borrowings.borrowed_at','desc')
            ->get();

        return view('user.borrowings.index',compact('borrowings'));
    }

    // 📥 Borrow a Book
    public function store($id)
    {
        $book = DB::table('books')->where('id',$id)->first();

        if(!$book || $book->quantity <= 0){
            return back()->with('error','Book unavailable');
        }

        DB::table('borrowings')->insert([
            'user_id'=>auth()->id(),
            'book_id'=>$book->id,
            'borrowed_at'=>now(),
            'status' => 'Borrowed'
        ]);

        DB::table('books')->where('id',$book->id)->decrement('quantity',1);

        AuditLogger::log('BORROW_BOOK',"Borrowed book ID: {$book->id}");

        return back()->with('success','Book borrowed successfully');
    }

    // 🔄 Return Book (Fixed)
    public function return($id)
    {
        $borrow = DB::table('borrowings')
            ->where('id',$id)
            ->where('user_id',auth()->id())
            ->first();

        if(!$borrow) return back()->with('error','Borrow record not found');

        DB::table('books')->where('id',$borrow->book_id)->increment('quantity',1);

        // 🔥 Do not delete — update status + store return date
        DB::table('borrowings')
            ->where('id',$id)
            ->update([
                'status' => 'Returned',
                'returned_at' => now(),
            ]);

        AuditLogger::log('RETURN_BOOK',"Returned book ID: {$borrow->book_id}");

        return back()->with('success','Book returned successfully');
    }
}
