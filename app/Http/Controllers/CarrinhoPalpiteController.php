<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoPalpite;
use App\Models\Rodada;
use Illuminate\Support\Facades\Auth;

class CarrinhoPalpiteController extends Controller
{



        public function carrinho()
    {
        $carrinhos = CarrinhoPalpite::with(['usuario', 'rodada'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Estatísticas básicas
        $totalCarrinhos = $carrinhos->count();
        $totalPendentes = $carrinhos->where('status', 'pendente')->count();
        $totalConfirmados = $carrinhos->where('status', 'confirmado')->count();

        return view('Admin.carrinho', compact(
            'carrinhos',
            'totalCarrinhos',
            'totalPendentes',
            'totalConfirmados'
        ));
    }
    public function salvarCarrinho(Request $request)
    {
        $usuarioId = Auth::id();
        $rodadaId = $request->rodada_id;
        $combinacao = $request->combinacao; // Ex: "1x2-1x-1x2-1x2"

        $rodada = Rodada::findOrFail($rodadaId);
        $valorBilheteBase = $rodada->valor_bilhete;

        $jogos = explode('-', $combinacao);
        $secas = $duplas = $triplas = 0;
        $totalBilhetes = 1;
        $opcoesJogos = [];

        foreach ($jogos as $palpite) {
            $opcoes = str_split(str_replace([' ', '-'], '', $palpite));
            $opcoesJogos[] = $opcoes;

            $qtd = count($opcoes);
            if ($qtd === 1) $secas++;
            elseif ($qtd === 2) $duplas++;
            elseif ($qtd === 3) $triplas++;

            $totalBilhetes *= $qtd;
        }

        $valorTotal = $totalBilhetes * $valorBilheteBase;
        $LIMITE_BILHETES = 1000;

        try {
            if ($totalBilhetes > $LIMITE_BILHETES) {
                // 🔸 Salva bilhete compactado (super bilhete)
                $carrinho = CarrinhoPalpite::create([
                    'usuario_id' => $usuarioId,
                    'rodada_id' => $rodadaId,
                    'quantidade_bilhetes' => $totalBilhetes,
                    'valor_total' => $valorTotal,
                    'combinacoes_compactadas' => $combinacao,
                    'status' => 'pendente',
                ]);

                $modo = 'compactado';
            } else {
                // 🔸 Gera todas as combinações individuais
                $todasCombinacoes = $this->gerarCombinacoes($opcoesJogos);

                foreach ($todasCombinacoes as $comb) {
                    CarrinhoPalpite::create([
                        'usuario_id' => $usuarioId,
                        'rodada_id' => $rodadaId,
                        'quantidade_bilhetes' => 1,
                        'valor_total' => $valorBilheteBase,
                        'combinacoes_compactadas' => implode('-', $comb),
                        'status' => 'pendente',
                    ]);
                }

                $modo = 'individual';
                $carrinho = null; // vários bilhetes foram criados
            }

            return response()->json([
                'success' => true,
                'modo' => $modo,
                'quantidade' => $totalBilhetes,
                'secas' => $secas,
                'duplas' => $duplas,
                'triplas' => $triplas,
                'valor_total' => number_format($valorTotal, 2, ',', '.'),
                'valor_base' => number_format($valorBilheteBase, 2, ',', '.'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar no carrinho: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Gera todas as combinações possíveis entre os palpites.
     * Ex: [["1","x"],["1","2"]] → [["1","1"],["1","2"],["x","1"],["x","2"]]
     */
    private function gerarCombinacoes($arrays)
    {
        $resultado = [[]];
        foreach ($arrays as $opcoes) {
            $novo = [];
            foreach ($resultado as $comb) {
                foreach ($opcoes as $opcao) {
                    $novo[] = array_merge($comb, [$opcao]);
                }
            }
            $resultado = $novo;
        }
        return $resultado;
    }

    
public function update(Request $request, $id)
{
    try {
        $carrinho = CarrinhoPalpite::findOrFail($id);

        $carrinho->update([
            'status' => $request->status,
            'valor_total' => $request->valor_total,
            'combinacoes_compactadas' => $request->combinacoes_compactadas,
        ]);

        return response()->json(['message' => 'Carrinho atualizado com sucesso.'], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Erro ao atualizar carrinho.',
            'error' => $e->getMessage(),
        ], 500);
    }
}




    public function destroy($id)
{
    $carrinho = CarrinhoPalpite::find($id);
    if (!$carrinho) {
        return response()->json(['success' => false, 'message' => 'Carrinho não encontrado.']);
    }

    $carrinho->delete();

    return response()->json(['success' => true]);
}

}
