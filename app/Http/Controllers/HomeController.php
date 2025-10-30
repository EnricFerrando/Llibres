<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function bifurcate()
    {
        if (!Auth::check()) {
            // If user is not authenticated, show welcome page
            return view('welcome');
        }
        
        if (Auth::user()->email === 'admin@admin.com') {
            // Redirect admin to admin panel
            return redirect()->intended(route('admin.index'));
        } else {
            // Redirect authenticated users to their index
            return redirect()->intended(route('index.guests'));
        }
    }
}
