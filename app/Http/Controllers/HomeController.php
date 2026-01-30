<?php

namespace App\Http\Controllers;

use App\Models\Rodada;
use App\Models\RodadaJogo;
use App\Models\Bilhete;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $agora = Carbon::now('America/Sao_Paulo');

        // ==========================
        // RODADA ATIVA
        // ==========================
        $rodada = Rodada::where('status', 'Ativo')
            ->where('data_fim', '>', $agora)
            ->orderBy('data_fim', 'asc')
            ->first();

        // ==========================
        // RODADAS PARA OS CARDS
        // ==========================
        $rodadasCards = Rodada::where('status', 'Encerrada')
            ->orderBy('data_fim', 'desc')
            ->limit(4)
            ->get()
            ->map(function ($rodada) {

                // Jogos da rodada
                $jogos = RodadaJogo::where('rodada_id', $rodada->id)->get();

                // Bilhetes pagos
                $bilhetes = Bilhete::with('carrinho')
                    ->whereHas('carrinho', function ($q) use ($rodada) {
                        $q->where('rodada_id', $rodada->id)
                          ->where('status', 'pago');
                    })
                    ->where('status', '!=', 'cancelado')
                    ->get();

                $totalBilhetes = $bilhetes->count();

                $acertosPorBilhete = [];

                // ==========================
                // CALCULA ACERTOS DE CADA BILHETE
                // ==========================
                foreach ($bilhetes as $bilhete) {

                    if (!$bilhete->carrinho || !$bilhete->carrinho->combinacoes_compactadas) {
                        continue;
                    }

                    $apostas = explode('-', $bilhete->carrinho->combinacoes_compactadas);
                    $acertos = 0;

                    foreach ($jogos as $i => $jogo) {
                        $aposta = $apostas[$i] ?? null;
                        $resultado = $jogo->resultado_real;

                        if (
                            $resultado &&
                            (
                                ($aposta === '1' && $resultado === 'casa') ||
                                ($aposta === 'x' && $resultado === 'empate') ||
                                ($aposta === '2' && $resultado === 'fora')
                            )
                        ) {
                            $acertos++;
                        }
                    }

                    $acertosPorBilhete[] = $acertos;
                }

                // ==========================
                // DEFINE GANHADORES
                // ==========================
                $maiorAcerto = empty($acertosPorBilhete)
                    ? 0
                    : max($acertosPorBilhete);

                $ganhadores = collect($acertosPorBilhete)
                    ->filter(fn ($a) => $a === $maiorAcerto)
                    ->count();

                return [
                    'id'             => $rodada->id,
                    'data'           => $rodada->data_fim->format('d/m'),
                    'premiacao'      => $rodada->premiacao_estimada ?? 0,
                    'total_bilhetes' => $totalBilhetes,
                    'ganhadores'     => $ganhadores,
                ];
            });

            $quantidadeCards = 4;
$cardsExistentes = $rodadasCards->count();
$cardsFaltantes  = max(0, $quantidadeCards - $cardsExistentes);

       return view('Paginas.User.Index', compact(
    'rodada',
    'rodadasCards',
    'cardsFaltantes'
));

    }
}
