<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rodada;
use App\Models\RodadaJogo;

class RankingController extends Controller
{
public function index($id = null)
{
    // Rodada atual
    if ($id) {
        $rodada = Rodada::findOrFail($id);
    } else {
        $rodada = Rodada::orderBy('id', 'DESC')->first();
    }

    // Carregar todos os jogos dessa rodada
    $jogos = RodadaJogo::where('rodada_id', $rodada->id)
        ->orderBy('id', 'ASC')
        ->get();

    // Últimas rodadas
    $ultimasRodadas = Rodada::where('id', '!=', $rodada->id)
        ->orderBy('id', 'DESC')
        ->limit(5)
        ->get();

    return view('Paginas.User.Ranking', compact('rodada', 'ultimasRodadas', 'jogos'));
}


}
