<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosAdminController extends Controller
{
public function index(Request $request)
{
    $query = User::with(['profile', 'referencia'])
                ->orderBy('id', 'desc');

    // 🔍 Filtro: busca por nome ou telefone
    if ($request->filled('busca')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'LIKE', '%'.$request->busca.'%')
              ->orWhere('phone', 'LIKE', '%'.$request->busca.'%');
        });
    }

    // 🔵 Filtro: status
    if ($request->filled('status') && $request->status !== 'todos') {
        $query->where('status', $request->status);
    }

    // 🟣 Filtro: perfil
    if ($request->filled('perfil') && $request->perfil !== 'todos') {
        $query->whereHas('profile', function ($q) use ($request) {
            $q->where('name', $request->perfil);
        });
    }

    // 🟠 Filtro: período
    if ($request->filled('recentes') && $request->recentes !== 'todos') {
        if ($request->recentes == "hoje") {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($request->recentes == "7") {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($request->recentes == "30") {
            $query->where('created_at', '>=', now()->subDays(30));
        }
    }

    $users = $query->get();

    // Estatísticas
    $totalUsuarios = User::count();
    $totalAtivos = User::where('status', 'Ativo')->count();
    $totalBloqueados = User::where('status', 'Bloqueado')->count();

    return view('Paginas.Admin.usuarios', compact(
        'users',
        'totalUsuarios',
        'totalAtivos',
        'totalBloqueados'
    ));
}


}
