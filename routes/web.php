<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Show the project's main index instead of the default Laravel welcome page
Route::get('/', function () {
    return view('rankIt.index.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Book routes - no auth required
Route::resource('books', BookController::class);
Route::get('/books/{book}/rate', [BookController::class, 'rate'])->name('books.rate');
Route::post('/books/{book}/rate', [BookController::class, 'storeRate'])->name('books.storeRate');

// User routes - no auth required
Route::resource('users', UserController::class);

// Category routes - no auth required
Route::resource('categories', CategoryController::class);

// Keep auth only for profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
