<?php

namespace App\Http\Controllers;

use App\Models\Categorie;

class CategoryController extends Controller
{
    public function show(Categorie $category)
    {
        return view('show_categories', compact('category'));
    }
}
