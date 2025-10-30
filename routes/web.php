<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Bifurcate will redirect admin users to the admin area and guests to the public index
Route::get('/', [HomeController::class, 'bifurcate']);

// User index with auth requirement
Route::get('/rankit', [UserController::class, 'index'])->middleware(['auth'])->name('index.guests');

// Admin routes (basic mapping). You can add middleware 'is_admin' later for protection.
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/books', [AdminController::class, 'books'])->name('books.index');
Route::get('/admin/users', [AdminController::class, 'users'])->name('users.index');
Route::get('/admin/categories', [AdminController::class, 'categories'])->name('categories.index');
Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
Route::get('/admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
Route::get('/admin/books/{id}/edit', [AdminController::class, 'editBook'])->name('books.edit');
Route::get('/admin/books/create', [AdminController::class, 'createBook'])->name('books.create');
Route::post('/admin/books', [AdminController::class, 'storeBook'])->name('books.store');
Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('categories.store');

// Book detail routes (available to all users)
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/rate', [BookController::class, 'rate'])->name('books.rate');
Route::post('/books/{book}/rate', [BookController::class, 'storeRate'])->name('books.rate.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
