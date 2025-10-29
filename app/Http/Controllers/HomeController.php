<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function bifurcate()
    {
        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            // Aquesta ruta només la podrà veure l'admin perquè el middleware ho controla
            return redirect()->intended(route('admin.index'));
        } else {
            return redirect()->intended(route('index.guests'));
        }
    }
}
