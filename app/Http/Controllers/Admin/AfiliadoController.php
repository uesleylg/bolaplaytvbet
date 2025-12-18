<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Indicacao;

class AfiliadoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;
        $filtroIndicacao = $request->indicacao;   // all, com, sem
        $filtroNivel = $request->nivel;

        $query = User::select('id', 'name', 'email', 'created_at')
            ->withCount(['indicacoes AS total_indicados']) // todos os indicados
            ->withCount(['indicacoes as total_validos' => function($q) { // apenas válidos (primeira ou recorrente)
                $q->whereIn('status', ['primeira', 'recorrente']);
            }]);

        // 🔍 Filtro de busca
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
        $totalPessoasIndicadas = Indicacao::where('resgatado', 1)->count();

        // Executa
        $afiliados = $query->get()->map(function ($item) {
            $item->comissao_total = 0; // placeholder
            return $item;
        });

      return view('Paginas.Admin.DashboardAfiliado', compact(
    'afiliados',
    'busca',
    'filtroIndicacao',
    'filtroNivel',
    'totalPessoasIndicadas'
));

    }

    public function index_individual(Request $request, $userId)
    {
        $user = User::with(['indicacoes.indicado'])->findOrFail($userId);

        // Lista de indicados do usuário
        $indicados = $user->indicacoes;

        return view('Paginas.Admin.indicadoindividual', compact('user', 'indicados'));
    }
}
