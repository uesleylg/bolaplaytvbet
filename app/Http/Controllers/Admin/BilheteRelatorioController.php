<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bilhete;
use App\Models\Rodada;
use App\Models\CarrinhoPalpite;
use Barryvdh\DomPDF\Facade\Pdf;

class BilheteRelatorioController extends Controller
{
    public function gerar($rodada_id)
    {
        // Carrega a rodada com os jogos
        $rodada = Rodada::with('jogos')->findOrFail($rodada_id);

        // Carrega bilhetes da rodada via carrinho
        $bilhetes = Bilhete::whereHas('carrinho', function ($q) use ($rodada_id) {
                $q->where('rodada_id', $rodada_id);
            })
            ->with('carrinho')
            ->orderBy('id', 'ASC')
            ->get();

        /**
         * ================================
         *  DESCOMPACTAÇÃO CORRETA POR CARRINHO
         * ================================
         */
        $bilhetesPorCarrinho = $bilhetes->groupBy('carrinho_id');

        foreach ($bilhetesPorCarrinho as $carrinhoId => $grupo) {

            $carrinho = $grupo->first()->carrinho;
            $compactado = $carrinho->combinacoes_compactadas;

            // Descompacta combinações (retorna array ou texto puro)
            $combinacoes = CarrinhoPalpite::descompactarCombinacoes($compactado);

            // Normaliza: garante que é array indexado
            $combinacoes = is_array($combinacoes) ? array_values($combinacoes) : [$combinacoes];

            // Para cada bilhete, atribui A SUA combinação correspondente
            foreach ($grupo->values() as $idx => $bilhete) {

                // Se não houver índice suficiente, define vazio
                $linha = $combinacoes[$idx] ?? '';

                if ($linha === '') {
                    $bilhete->palpites = [];
                } else {
                    // "1-x-2-x" → array
                    $bilhete->palpites = explode('-', $linha);
                }
            }
        }

        // Divide em páginas de 24 bilhetes
        $paginas = $bilhetes->chunk(24);

        // Gera PDF
        $pdf = Pdf::loadView('Paginas.Admin.Relatorio.BilhetesComprados', [
            'rodada'  => $rodada,
            'paginas' => $paginas
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download("bilhetes_rodada_{$rodada->id}.pdf");
    }
}
