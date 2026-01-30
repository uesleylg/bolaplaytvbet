<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Rodada;
use App\Models\Bilhete;
use App\Models\CarrinhoPalpite;
use App\Models\User;
use Carbon\Carbon;


class HomeAdminController extends Controller
{
    public function index(Request $request)
    {
        // Todas as rodadas
        $rodadas = Rodada::orderBy('id', 'desc')->get();

        // Rodada selecionada
        $rodadaSelecionada = $request->rodadas;


        /*
         |------------------------------------------------------------------
         | CONSULTAS DOS CARDS + LISTAGEM COM PAGINAÇÃO
         |------------------------------------------------------------------
        */

        if ($rodadaSelecionada) {

            // Base filtrada por rodada
            $carrinhosBase = CarrinhoPalpite::where('rodada_id', $rodadaSelecionada);

            // 🔥 Salva IDs antes de usar a query
            $carrinhosIds = $carrinhosBase->pluck('id')->toArray();

            // Listagem paginada
            $carrinhosListagem = CarrinhoPalpite::with('usuario:id,name')
                ->whereIn('id', $carrinhosIds)
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->appends(['rodadas' => $rodadaSelecionada]);


            // 🔥 Total de carrinhos (desconsiderando pagos)
            $totalCarrinhos = CarrinhoPalpite::whereIn('id', $carrinhosIds)
                ->where('status', '!=', 'pago')
                ->count();



            // 🔥 Total de bilhetes da rodada
            $totalBilhetes = Bilhete::whereIn('carrinho_id', $carrinhosIds)->count();


            // Total de usuários únicos
            $totalUsuarios = CarrinhoPalpite::whereIn('id', $carrinhosIds)
                ->distinct('usuario_id')
                ->count('usuario_id');


            // 🔥 Faturamento = soma de carrinhos pagos, independente dos bilhetes
            $totalFaturamento = CarrinhoPalpite::whereIn('id', $carrinhosIds)
                ->where('status', 'pago')
                ->sum('valor_total');

        } else {

            // Listagem geral paginada
            $carrinhosListagem = CarrinhoPalpite::with('usuario:id,name')
                ->orderBy('id', 'desc')
                ->paginate(10);

            // Totais gerais
            $totalCarrinhos = CarrinhoPalpite::where('status', '!=', 'pago')->count();
            $totalBilhetes  = Bilhete::count();
            $totalUsuarios  = User::count();

            // 🔥 Faturamento geral = soma dos pagos
            $totalFaturamento = CarrinhoPalpite::where('status', 'pago')
                ->sum('valor_total');
        }

        $ultimaAtualizacao = now();

        $agora = Carbon::now();

$totalUsuariosGeral = User::count();

$usuarios24h = User::where('created_at', '>=', $agora->copy()->subHours(24))->count();

$usuarios7d = User::where('created_at', '>=', $agora->copy()->subDays(7))->count();


       return view('Paginas.Admin.index', compact(
    'rodadas',
    'rodadaSelecionada',
    'totalBilhetes',
    'totalCarrinhos',
    'totalUsuarios',
    'totalFaturamento',
    'carrinhosListagem',
    'ultimaAtualizacao',

    // 🔥 novos
    'totalUsuariosGeral',
    'usuarios24h',
    'usuarios7d'
));

    }
}
