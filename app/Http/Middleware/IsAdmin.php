<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Comprova si l'usuari està autenticat i és admin
        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            return $next($request);
        } 
            return redirect("/")->with('Accés no autoritzat');
     }
}
