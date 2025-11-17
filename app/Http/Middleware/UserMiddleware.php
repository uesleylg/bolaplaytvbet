<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver logado → voltar para home
        if (!Auth::check()) {
            return redirect()->route('home.index')->with('error', 'Faça login para continuar.');
        }

        return $next($request);
    }
}
