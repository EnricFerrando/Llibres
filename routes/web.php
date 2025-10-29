<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('bifurcate');
    }
    return view('welcome');
})->name('welcome');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/bifurcate', [HomeController::class, 'bifurcate'])->name('bifurcate'); 

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/index', [UserController::class, 'index'])->name('index.guests');
    Route::get('/books/{book}', [\App\Http\Controllers\BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/rate', [\App\Http\Controllers\BookController::class, 'rate'])->name('books.rate');
    Route::post('/books/{book}/rate', [\App\Http\Controllers\BookController::class, 'storeRate'])->name('books.rate.store');
    Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');


    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/index/books', [AdminController::class, 'books'])->name('books.index');
        Route::get('/admin/index/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/admin/index/categories', [AdminController::class, 'categories'])->name('categories.index');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/admin/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
        Route::put('/admin/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/admin/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
        Route::get('/admin/books/{book}/edit', [AdminController::class, 'editBook'])->name('books.edit');
        Route::put('/admin/books/{book}', [AdminController::class, 'updateBook'])->name('books.update');
        Route::delete('/admin/books/{book}', [AdminController::class, 'destroyBook'])->name('books.destroy');
        Route::get('/admin/books/create', [AdminController::class, 'createBook'])->name('books.create');
        Route::post('/admin/books', [AdminController::class, 'storeBook'])->name('books.store');
        Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
        Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    });
}); 



require __DIR__ . '/auth.php';
