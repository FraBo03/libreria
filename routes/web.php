<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAdminReader;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'homepage'])->name("home");

Route::resource('books', BookController::class);
Route::resource('loans', LoanController::class);
Route::resource('tags', TagController::class)->middleware(CheckAdmin::class . ':admin');

Route::get('/books/create', [BookController::class, 'create'])->name("books.create")->middleware(CheckAdmin::class . ':admin');
Route::get('/loans/create', [LoanController::class, 'create'])->name("loans.create")->middleware(CheckAdmin::class . ':admin');
Route::get('/books/{book}/edit', [BookController::class,'edit'])->name("books.edit")->middleware(CheckAdmin::class . ':admin');
Route::get('/loans/{loan}/edit', [LoanController::class,'edit'])->name("loans.edit")->middleware(CheckAdmin::class . ':admin');
Route::get('/loans', [LoanController::class, 'index'])->name("loans.index")->middleware(CheckAdminReader::class . ':admin');

Route::get('/reader', [LoanController::class, 'reader'])->name("reader");

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/aigenerated/create', [BookController::class, 'create'])->name('aigenerated.create');
Route::post('/aigenerated', [BookController::class, 'store'])->name('aigenerated.store');