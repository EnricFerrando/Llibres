<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(12);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'sumary' => 'required',
            'published_at' => 'required|date',
            'price' => 'required|numeric|min:0',
            'recomended_age' => 'required|integer|min:0',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $validated['image'] = $path;
        }

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('status', 'Llibre creat correctament!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function rate(Book $book)
    {
        return view('books.rate', compact('book'));
    }

    public function storeRate(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $book->users()->syncWithoutDetaching([
            Auth::user()->id => [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Valoració guardada!');
    }
}
