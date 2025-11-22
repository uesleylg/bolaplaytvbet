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

public function jogos_live($rodada_id)
{
    // 1️⃣ Validação do ID
    if (!is_numeric($rodada_id)) {
        return response()->json(['error' => 'ID da rodada inválido.'], 400);
    }

    // 2️⃣ Verifica se a rodada existe
    $rodada = Rodada::find($rodada_id);
    if (!$rodada) {
        return response()->json(['error' => 'Rodada não encontrada.'], 404);
    }

    // 3️⃣ Busca somente os campos necessários (evita expor dados sensíveis)
    $jogos = RodadaJogo::where('rodada_id', $rodada_id)
        ->select([
            'id', 
            'time_casa_nome', 'time_fora_nome', 
            'time_casa_brasao', 'time_fora_brasao',
            'status_jogo', 'placar_casa', 'placar_fora', 'competicao'
        ])
        ->orderBy('id', 'ASC')
        ->get();

    // 4️⃣ Retorno JSON
    return response()->json([
        'rodada_id' => $rodada_id,
        'jogos' => $jogos
    ], 200);
}



}
