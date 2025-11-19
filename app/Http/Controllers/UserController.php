<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::all();
        $categoryId = $request->input('categorie_id');

        $booksQuery = Book::query();

        if ($categoryId) {
            $booksQuery->where('categorie_id', $categoryId);
        }

        $books = $booksQuery->paginate(6);

        return view('users.index', compact('books', 'categories', 'categoryId'));
    }
}
