<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;

class LogController extends Controller
{
  public function logs(Request $request)
{
    // Começa a query
    $query = Logs::query();

    // Filtro por pesquisa (usuário, IP ou ação)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('usuario', 'like', "%{$search}%")
              ->orWhere('ip', 'like', "%{$search}%")
              ->orWhere('acao', 'like', "%{$search}%");
        });
    }

    // Filtro por tipo
    if ($request->filled('tipo')) {
        $query->where('tipo', $request->input('tipo'));
    }

    // Ordenação
    if ($request->input('ordenar') === 'antigo') {
        $query->orderBy('created_at', 'asc');
    } else { // padrão recente
        $query->orderBy('created_at', 'desc');
    }

    // Pega os logs paginados (10 por página) e mantém os parâmetros de busca/filtro
    $logs = $query->paginate(10)->withQueryString();

    return view('Paginas.Admin.logssistema', compact('logs'));
}

}
