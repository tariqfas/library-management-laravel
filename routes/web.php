<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\Author;
use App\Http\Livewire\Book;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\IssueBook;
use App\Http\Livewire\Publisher;
use App\Http\Livewire\Student;
use App\Http\Livewire\Report;
use App\Http\Livewire\Setting;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('role:admin')->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/author', Author::class)->name('author');
    Route::get('/category', Category::class)->name('category');
    Route::get('/publisher', Publisher::class)->name('publisher');
    Route::get('/book', Book::class)->name('book');
    Route::get('/student', Student::class)->name('student');
    Route::get('/issue-book', IssueBook::class)->name('issue-book');
    Route::get('/report', Report::class)->name('report');
    Route::get('/settings', Setting::class)->name('settings');
});


Route::get('/', [BookController::class,'index'])->name('home');
// Rating book 
Route::post('/book/rate', [BookController::class,'rateBookStore'])->name('rate.store');

Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register');
Route::get('/books/{id}', [BookController::class,'getBook'])->name('book.details');

Route::get('/user/dashboard', function (){
    return view('user.dashboard');
})->middleware('role:user')->name('user.dashboard');

// Fallback route for "Not Found" page
Route::fallback(function () {
    return view('404'); // Assuming you have a "404.blade.php" file in the "resources/views/errors" directory
});

// for the regrouping of routes
/* 
Route::middleware('role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});
*/