<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Categorie;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('rankIt.index.index');
    }

    public function books()
    {
        $books = Book::all();
        return view('rankIt.index.books', compact('books'));
    }

    public function users()
    {
        $users = User::all();
        return view('rankIt.index.users', compact('users'));
    }

    public function categories()
    {
        $categories = Categorie::all();
        return view('rankIt.index.categories', compact('categories'));
    }

    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('rankIt.index.edit_user', compact('user'));
    }

    public function destroyUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuari esborrat correctament.');
    }
    public function editCategory($id)
    {
        $category = \App\Models\Categorie::findOrFail($id);
        return view('edit_categorie', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = \App\Models\Categorie::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoria actualitzada correctament.');
    }

    public function destroyCategory($id)
    {
        $category = \App\Models\Categorie::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoria esborrada correctament.');
    }

    public function editBook($id)
    {
        $book = \App\Models\Book::findOrFail($id);
        return view('edit_book', compact('book'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = \App\Models\Book::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            // afegeix la resta de camps segons el teu model
        ]);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Llibre actualitzat correctament.');
    }

    public function destroyBook($id)
    {
        $book = \App\Models\Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Llibre esborrat correctament.');
    }

    public function createBook()
    {
        // Si tens categories, passa-les a la vista
        $categories = \App\Models\Categorie::all();
        return view('create_book', compact('categories'));
    }

    // Desa el llibre nou a la base de dades
    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'sumary' => 'nullable|string',
            'published_at' => 'nullable|date',
            'price' => 'nullable|numeric',
            'recomended_age' => 'nullable|integer',
            'categorie_id' => 'nullable|exists:Categories,id',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Llibre creat correctament!');
    }

    public function createCategory()
{
    return view('create_categorie');
}

// Desa la nova categoria a la base de dades
public function storeCategory(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:Categories,name',
    ]);

    Categorie::create([
        'name' => $request->name,
    ]);

    return redirect()->route('categories.index')->with('success', 'Categoria creada correctament!');
}
}
