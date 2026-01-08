<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// USER Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\BorrowingController;
use App\Http\Controllers\User\ProfileController;

// ADMIN Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\UserManagementController;


/*==========================================================================
| ERROR TEST ROUTES (debug only)
==========================================================================*/
Route::get('/forbidden-test', fn()=>abort(403));
Route::get('/error-test', fn()=>abort(500));
Route::get('/not-found-test', fn()=>abort(404));


/*==========================================================================
| PUBLIC ROUTES
==========================================================================*/
Route::get('/', fn()=>view('user.home'))->name('home');
Route::get('/about', fn()=>view('user.about'))->name('about');


/*==========================================================================
| AUTH ROUTES
==========================================================================*/
require __DIR__.'/auth.php';


/*==========================================================================
| USER ROUTES (Logged-in user)
==========================================================================*/
Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard',[UserDashboardController::class,'index'])->name('dashboard');

    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

    Route::get('/books',[UserBookController::class,'index'])->name('books.index');
    Route::get('/books/{id}',[UserBookController::class,'show'])->name('books.show');

    Route::get('/borrowings',[BorrowingController::class,'index'])->name('borrowings.index');
    Route::post('/borrow/{id}',[BorrowingController::class,'store'])->name('borrowings.store');
    Route::delete('/borrowings/{id}',[BorrowingController::class,'return'])->name('borrowings.return');
});


/*==========================================================================
| ADMIN ROUTES (Only Admin Can Access)
==========================================================================*/
Route::middleware(['auth','admin.auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

    // 📚 BOOKS
    Route::get('/books/list',[AdminBookController::class,'index'])->name('books.list');
    Route::get('/books/create',[AdminBookController::class,'create'])->name('books.create');
    Route::post('/books/store',[AdminBookController::class,'store'])->name('books.store');
    Route::get('/books/{id}/edit',[AdminBookController::class,'edit'])->name('books.edit');
    Route::put('/books/{id}',[AdminBookController::class,'update'])->name('books.update');
    Route::delete('/books/{id}',[AdminBookController::class,'destroy'])->name('books.delete');

    // 👥 USER MANAGEMENT
    Route::get('/users',[UserManagementController::class,'index'])->name('users');
    Route::post('/users/update/{id}',[UserManagementController::class,'update'])->name('users.update');
    Route::post('/users/reset-password/{id}',[UserManagementController::class,'resetPassword'])->name('users.resetpw');
    Route::delete('/users/delete/{id}',[UserManagementController::class,'destroy'])->name('users.delete');

    // 📄 BORROW RECORDS (Correct Placement)
    Route::get('/borrow-records',[App\Http\Controllers\Admin\BorrowRecordController::class,'index'])
        ->name('borrow.records');

    // 📝 AUDIT LOGS
    Route::get('/audit-logs',[AuditLogController::class,'index'])->name('audit.logs');

    // 🚪 LOGOUT
    Route::post('/logout',function(Request $request){
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});


/*==========================================================================
| SECURE IMAGE (Book Display Protected)
==========================================================================*/
Route::get('/secure/book/{file}',function(Request $request,$file){

    $path='books/'.$file;

    abort_unless(Storage::disk('public')->exists($path),404);

    return response(
        Storage::disk('public')->get($path),
        200,
        ['Content-Type'=>Storage::disk('public')->mimeType($path)]
    );

})->middleware('auth')->where('file','.*')->name('secure.book');
