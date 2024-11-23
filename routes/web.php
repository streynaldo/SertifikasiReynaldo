<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserViewController;

Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::post('/login', [AuthController::class, 'ValidateLogin'])->name('validate-login');
Route::get('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/register', [AuthController::class, 'ValidateRegister'])->name('validate-register');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');



Route::middleware(['user'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/book-list', [UserViewController::class, 'index'])->name('book-list');
    Route::get('/book-list/borrow-list', [UserViewController::class, 'borrowList'])->name('borrow-list');
    Route::put('/book-list/borrow/{id}', [UserViewController::class, 'borrow'])->name('borrow');
    Route::put('/book-list/bring-back/{id}', [UserViewController::class, 'bringBack'])->name('bring-back');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('dashboard');
    Route::put('/books/{id}/return', [BookController::class, 'returnBook'])->name('books.return');
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

});
