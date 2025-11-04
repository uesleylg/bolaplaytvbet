<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Faça login para continuar.');
        }

        $user = Auth::user();

        // 🔹 Verifica se o usuário tem perfil e se é admin
        if (!$user->profile || $user->profile->name !== 'admin') {
            abort(403, 'Acesso negado. Somente administradores podem acessar esta área.');
        }

        return $next($request);
    }
}
