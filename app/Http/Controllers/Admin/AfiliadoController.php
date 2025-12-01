<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AfiliadoController extends Controller
{
   public function index(Request $request)
{
    $busca = $request->busca;
    $filtroIndicacao = $request->indicacao;   // all, com_indicados, sem_indicados
    $filtroNivel = $request->nivel;

    $query = User::select('id', 'name', 'email', 'created_at')
        ->withCount(['indicados AS total_indicados']);

    // 🔍 Filtro de busca por ID ou nome
    if (!empty($busca)) {
        $query->where(function ($q) use ($busca) {
            $q->where('name', 'like', "%{$busca}%")
              ->orWhere('id', $busca)
              ->orWhere('email', 'like', "%{$busca}%");
        });
    }

    // 🎯 Filtro: apenas usuários com indicados
    if ($filtroIndicacao === 'com') {
        $query->having('total_indicados', '>', 0);
    }

    // 🎯 Filtro: apenas usuários sem indicados
    if ($filtroIndicacao === 'sem') {
        $query->having('total_indicados', '=', 0);
    }

    // 🎯 Filtro por nível (quantidade de indicados)
    if (!empty($filtroNivel)) {
        $query->having('total_indicados', '=', $filtroNivel);
    }

    // Executa
    $afiliados = $query->get()->map(function ($item) {
        $item->comissao_total = 0;
        return $item;
    });

    return view('Paginas.Admin.DashboardAfiliado', compact(
        'afiliados', 'busca', 'filtroIndicacao', 'filtroNivel'
    ));
}

}
