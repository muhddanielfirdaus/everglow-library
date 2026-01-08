<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\AuditLogger;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->orderBy('id','desc')->get();
        return view('admin.books-information', compact('books'));
    }

    public function create()
    {
        return view('admin.books');
    }

    /*=====================================================================
      📌 STORE BOOK (Secure Upload + Validation + Logging)
    =====================================================================*/
    public function store(Request $request)
    {
        // 🔐 SSDEV Required Input Validation
        $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'status'   => 'required|in:Active,Inactive',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagePath = null;

        // 📂 SECURE IMAGE UPLOAD
        if($request->hasFile('image')){
            $file     = $request->file('image');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $imagePath = $file->storeAs('books',$filename,'public');
        }

        // 🗂 Insert into DB (Escape Input)
        DB::table('books')->insert([
            'title'      => e($request->title),
            'author'     => e($request->author),
            'category'   => e($request->category),
            'quantity'   => $request->quantity,
            'status'     => $request->status,
            'image'      => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        AuditLogger::log('BOOK_CREATED',"Added book: {$request->title}");

        return back()->with('success','Book added successfully!');
    }


    /*=====================================================================
      📌 EDIT BOOK PAGE
    =====================================================================*/
    public function edit($id)
    {
        $book = DB::table('books')->where('id',$id)->first();
        if(!$book) return back()->with('error','Book not found');

        return view('admin.books-edit',compact('book'));
    }


    /*=====================================================================
      📌 UPDATE BOOK (Image Replace + Security Validation)
    =====================================================================*/
    public function update(Request $request,$id)
    {
        // 🔐 Validation
        $request->validate([
            'title'    => 'required|string|max:255',
            'author'   => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'status'   => 'required|in:Active,Inactive',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $book = DB::table('books')->where('id',$id)->first();
        if(!$book) return back()->with('error','Book not found');

        $imagePath = $book->image;

        // 🖼 Replace existing image if new uploaded
        if($request->hasFile('image')){
            if($book->image && Storage::disk('public')->exists($book->image)){
                Storage::disk('public')->delete($book->image);
            }

            $filename  = Str::uuid().'.'.$request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('books',$filename,'public');
        }

        DB::table('books')->where('id',$id)->update([
            'title'      => e($request->title),
            'author'     => e($request->author),
            'category'   => e($request->category),
            'quantity'   => $request->quantity,
            'status'     => $request->status,
            'image'      => $imagePath,
            'updated_at' => now(),
        ]);

        AuditLogger::log('BOOK_UPDATED', "Book ID $id updated");

        return redirect()->route('admin.books.list')->with('success','📘 Book Updated Successfully!');
    }


    /*=====================================================================
      📌 DELETE BOOK (File + DB)
    =====================================================================*/
    public function destroy($id)
    {
        $book = DB::table('books')->where('id',$id)->first();

        if($book){
            if($book->image && Storage::disk('public')->exists($book->image)){
                Storage::disk('public')->delete($book->image);
            }

            DB::table('books')->where('id',$id)->delete();
            AuditLogger::log('BOOK_DELETED',"Deleted book ID: $id");
        }

        return back()->with('success','🗑 Book deleted');
    }
}
