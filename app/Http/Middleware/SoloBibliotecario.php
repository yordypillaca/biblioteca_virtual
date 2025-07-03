<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SoloBibliotecario
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rol === 'bibliotecario') {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado.');
    }
}
