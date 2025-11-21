<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManutencaoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 🔑 CHAVE DE DESBLOQUEIO DO DESENVOLVEDOR
        $chave = 'MINHACHAVE123';  // troque por algo forte

        // Se a chave vier na URL → desbloqueia a sessão
        if ($request->query('unlock') === $chave) {
            session(['dev_unlocked' => true]);
        }

        // Se já está desbloqueado → libera tudo
        if (session('dev_unlocked') === true) {
            return $next($request);
        }

        // Buscar modo manutenção do banco
        $modo = DB::table('configuracoes')
            ->where('chave', 'modo_manutencao')
            ->value('valor');

        // Se NÃO está em manutenção → libera
        if ($modo != '1') {
            return $next($request);
        }

        // Admin logado pode acessar
      if (Auth::check() && Auth::user()->profile_id == 3) {
    return $next($request);
}

        // Qualquer outro → página de manutenção
        return response()->view('Layout.Manutencao.manutencao');
    }
}
