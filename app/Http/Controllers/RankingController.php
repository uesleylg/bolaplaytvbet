<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rodada;
use App\Models\RodadaJogo;
use App\Models\Bilhete;
use Illuminate\Pagination\LengthAwarePaginator;

class RankingController extends Controller
{
    public function index(Request $request, $id = null)
    {
        // ==========================
        // RODADA
        // ==========================
        $rodada = $id
            ? Rodada::findOrFail($id)
            : Rodada::orderBy('id','DESC')->first();

        // ==========================
        // JOGOS
        // ==========================
        $jogos = RodadaJogo::where('rodada_id',$rodada->id)
            ->orderBy('id','ASC')
            ->get();

        // ==========================
        // ÚLTIMAS RODADAS
        // ==========================
        $ultimasRodadas = Rodada::where('id','!=',$rodada->id)
            ->orderBy('id','DESC')
            ->limit(5)
            ->get();

        // ==========================
        // CONTAGEM
        // ==========================
        $bilhetesSite = Bilhete::join('carrinho_palpites','bilhetes.carrinho_id','=','carrinho_palpites.id')
            ->where('carrinho_palpites.rodada_id',$rodada->id)
            ->where('carrinho_palpites.status','pago')
            ->where('bilhetes.status','!=','cancelado')
            ->count();

        $bilhetesExternos = (int) ($rodada->bilhete_externo ?? 0);
        $totalBilhetes = $bilhetesSite + $bilhetesExternos;

        // ==========================
        // BUSCA
        // ==========================
        $busca = $request->get('busca');

        // ==========================
        // BILHETES
        // ==========================
        $bilhetes = Bilhete::with('carrinho.usuario')
            ->whereHas('carrinho', function ($q) use ($rodada) {
                $q->where('rodada_id',$rodada->id)
                  ->where('status','pago');
            })
            ->where('status','!=','cancelado')
            ->when($busca, function ($q) use ($busca) {
                $q->where('codigo_bilhete','like','%'.$busca.'%');
            })
            ->get();

        // ==========================
        // PROCESSA APOSTAS
        // ==========================
        foreach ($bilhetes as $bilhete) {

            $carrinho = $bilhete->carrinho;

            if (!$carrinho || !$carrinho->combinacoes_compactadas) {
                $bilhete->apostas_formatadas = [];
                $bilhete->acertos = 0;
                continue;
            }

            $apostas = explode('-', $carrinho->combinacoes_compactadas);
            $acertos = 0;
            $final = [];

            foreach ($jogos as $i => $jogo) {

                $aposta = $apostas[$i] ?? null;
                $resultado = $jogo->resultado_real;
                $status = 'pendente';

                if ($resultado) {
                    if (
                        ($aposta === '1' && $resultado === 'casa') ||
                        ($aposta === 'x' && $resultado === 'empate') ||
                        ($aposta === '2' && $resultado === 'fora')
                    ) {
                        $status = 'acertou';
                        $acertos++;
                    } else {
                        $status = 'errou';
                    }
                }

             $final[] = [
    'time_casa'   => $jogo->time_casa_nome,
    'time_fora'   => $jogo->time_fora_nome,
    'status'      => $status,

    // 🔥 NOVOS CAMPOS (modal)
    'aposta'      => $aposta, // 1, x, 2
    'placar_casa' => $jogo->placar_casa,
    'placar_fora' => $jogo->placar_fora,
];

            }

            $bilhete->apostas_formatadas = $final;
            $bilhete->acertos = $acertos;
        }

        // ==========================
        // ORDENA
        // ==========================
        $rankingOrdenado = $bilhetes->sortByDesc('acertos')->values();

        // ==========================
        // PAGINAÇÃO
        // ==========================
        $porPagina   = 10;
        $paginaAtual = $request->get('page',1);

        $ranking = new LengthAwarePaginator(
            $rankingOrdenado->slice(($paginaAtual-1)*$porPagina,$porPagina)->values(),
            $rankingOrdenado->count(),
            $porPagina,
            $paginaAtual,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        // ==========================
        // ESTATÍSTICAS (GERAL)
        // ==========================
        $estatisticas = [8=>0,7=>0,6=>0,0=>0];

        foreach ($rankingOrdenado as $b) {
            if ($b->acertos >= 8) $estatisticas[8]++;
            elseif ($b->acertos === 7) $estatisticas[7]++;
            elseif ($b->acertos === 6) $estatisticas[6]++;
            elseif ($b->acertos === 0) $estatisticas[0]++;
        }

        return view('Paginas.User.Ranking', compact(
            'rodada',
            'ultimasRodadas',
            'jogos',
            'bilhetesSite',
            'bilhetesExternos',
            'totalBilhetes',
            'ranking',
            'estatisticas'
        ));
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
