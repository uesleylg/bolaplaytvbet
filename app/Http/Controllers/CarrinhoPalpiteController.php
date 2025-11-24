<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoPalpite;
use App\Models\Rodada;
use Illuminate\Support\Facades\Auth;

class CarrinhoPalpiteController extends Controller
{



     public function carrinho(Request $request)
{
    $query = CarrinhoPalpite::with(['usuario', 'rodada']);

    /* -----------------------------
       FILTRO: Busca por ID ou usuário
       ----------------------------- */
    if ($request->filled('busca')) {
        $busca = $request->busca;

        $query->where(function($q) use ($busca) {
            $q->where('id', $busca)
              ->orWhereHas('usuario', function($q2) use ($busca) {
                  $q2->where('name', 'like', "%$busca%")
                     ->orWhere('phone', 'like', "%$busca%");
              });
        });
    }

    /* -----------------------------
       FILTRO: Status
       ----------------------------- */
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    /* -----------------------------
       FILTRO: Rodada
       ----------------------------- */
    if ($request->filled('rodada')) {
        $query->where('rodada_id', $request->rodada);
    }

    /* -----------------------------
       FILTRO: Recentes (dias)
       ----------------------------- */
    if ($request->filled('recentes')) {
        if ($request->recentes === 'hoje') {
            $query->whereDate('created_at', now()->toDateString());
        } else {
            $dias = intval($request->recentes);
            $query->where('created_at', '>=', now()->subDays($dias));
        }
    }

    /* -----------------------------
       Ordenação (padrão: recentes)
       ----------------------------- */
    $carrinhos = $query->orderBy('created_at', 'desc')->get();

    // Estatísticas
    $totalCarrinhos = $carrinhos->count();
    $totalPendentes = $carrinhos->where('status', 'pendente')->count();
    $totalConfirmados = $carrinhos->where('status', 'confirmado')->count();

    // Carregar rodadas para o select
    $rodadas = Rodada::all();

    return view('Paginas.Admin.carrinho', compact(
        'carrinhos',
        'totalCarrinhos',
        'totalPendentes',
        'totalConfirmados',
        'rodadas'
    ));
}

public function salvarCarrinho(Request $request)
{
    $usuarioId = Auth::id();
    $rodadaId = $request->rodada_id;
    $combinacao = $request->combinacao;

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

        $bilheteIds = []; // <<--- IMPORTANTE

        if ($totalBilhetes > $LIMITE_BILHETES) {

            $carrinho = CarrinhoPalpite::create([
                'usuario_id' => $usuarioId,
                'rodada_id' => $rodadaId,
                'quantidade_bilhetes' => $totalBilhetes,
                'valor_total' => $valorTotal,
                'combinacoes_compactadas' => $combinacao,
                'status' => 'pendente',
            ]);

            $bilheteIds[] = $carrinho->id; // <<---- PEGANDO O ID

        } else {

            $todasCombinacoes = $this->gerarCombinacoes($opcoesJogos);

            foreach ($todasCombinacoes as $comb) {

                $novo = CarrinhoPalpite::create([
                    'usuario_id' => $usuarioId,
                    'rodada_id' => $rodadaId,
                    'quantidade_bilhetes' => 1,
                    'valor_total' => $valorBilheteBase,
                    'combinacoes_compactadas' => implode('-', $comb),
                    'status' => 'pendente',
                ]);

                $bilheteIds[] = $novo->id; // <<---- PEGANDO O ID
            }
        }

        return response()->json([
            'success' => true,
            'bilhete_ids' => $bilheteIds,  // <<---- RETORNANDO PARA JS
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao salvar: ' . $e->getMessage(),
        ], 500);
    }
}



public function excluir($id)
{
    try {
        $carrinho = CarrinhoPalpite::findOrFail($id);

        // Garante que o bilhete pertence ao usuário logado
        if ($carrinho->usuario_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para excluir este bilhete.'
            ], 403);
        }

        $carrinho->delete();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao excluir: ' . $e->getMessage()
        ], 500);
    }
}



    public function atualizarCarrinho(Request $request, $id)
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
        $carrinho = CarrinhoPalpite::findOrFail($id);

        // Atualiza dados principais
        $carrinho->update([
            'rodada_id' => $rodadaId,
            'quantidade_bilhetes' => $totalBilhetes,
            'valor_total' => $valorTotal,
            'combinacoes_compactadas' => $combinacao,
            'status' => 'pendente',
        ]);

        return response()->json([
            'success' => true,
            'modo' => 'editado',
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
            'message' => 'Erro ao atualizar o carrinho: ' . $e->getMessage(),
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
