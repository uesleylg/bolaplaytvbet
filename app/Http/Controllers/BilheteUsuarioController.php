<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoPalpite;
use App\Models\RodadaJogo; // 🔥 ADICIONADO
use Illuminate\Support\Facades\Auth;

class BilheteUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarioId = Auth::id();
        $busca = $request->input('busca');
        $status = $request->input('status', 'todos');

        $bilhetes = CarrinhoPalpite::with('bilhete')
            ->where('usuario_id', $usuarioId)
            ->when($status !== 'todos', function($query) use ($status) {
                if ($status === 'pendente') {
                    $query->where('status', 'pendente')
                        ->whereHas('rodada', function ($r) {
                            $r->where('data_fim', '>=', now())
                              ->whereNotIn('status', ['Encerrada', 'bloqueado']);
                        });
                } elseif ($status === 'aguardando-pago') {
                    $query->where('status', 'pago')
                        ->whereHas('bilhete', function($b) {
                            $b->where('status', 'aberto');
                        });
                } elseif ($status === 'ganhos') {
                    $query->whereHas('bilhete', function($b) {
                        $b->where('status', 'ganho');
                    });
                }
            })
            ->when($status === 'todos', function($query) {
                $query->where(function($q) {
                    $q->where(function($p) {
                        $p->where('status', 'pendente')
                          ->whereHas('rodada', function($r) {
                              $r->where('data_fim', '>=', now())
                                ->whereNotIn('status', ['Encerrada', 'bloqueado']);
                          });
                    })
                    ->orWhere('status', 'pago');
                });
            })
            ->when($busca, function($query, $busca) {
                $query->whereHas('bilhete', function($q) use ($busca) {
                    $q->where('codigo_bilhete', 'like', "%{$busca}%")
                      ->orWhere('id', $busca);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // ==================================================
        // 🔥 PROCESSA APOSTAS (IGUAL AO RANKING)
        // ==================================================
        $rodadasCache = [];

        foreach ($bilhetes as $carrinho) {

            if (!$carrinho->bilhete || !$carrinho->combinacoes_compactadas) {
                $carrinho->apostas_formatadas = [];
                $carrinho->acertos = 0;
                continue;
            }

            $rodadaId = $carrinho->rodada_id;

            // Cache de jogos por rodada (performance)
            if (!isset($rodadasCache[$rodadaId])) {
                $rodadasCache[$rodadaId] = RodadaJogo::where('rodada_id', $rodadaId)
                    ->orderBy('id', 'ASC')
                    ->get();
            }

            $jogos = $rodadasCache[$rodadaId];
            $apostas = explode('-', $carrinho->combinacoes_compactadas);

            $final = [];
            $acertos = 0;

            foreach ($jogos as $i => $jogo) {

                $aposta = $apostas[$i] ?? null;
                $resultado = $jogo->resultado_real;
                $statusAposta = 'pendente';

                if ($resultado) {
                    if (
                        ($aposta === '1' && $resultado === 'casa') ||
                        ($aposta === 'x' && $resultado === 'empate') ||
                        ($aposta === '2' && $resultado === 'fora')
                    ) {
                        $statusAposta = 'acertou';
                        $acertos++;
                    } else {
                        $statusAposta = 'errou';
                    }
                }

                $final[] = [
                    'time_casa'   => $jogo->time_casa_nome,
                    'time_fora'   => $jogo->time_fora_nome,
                    'status'      => $statusAposta,
                    'aposta'      => $aposta,
                    'placar_casa' => $jogo->placar_casa,
                    'placar_fora' => $jogo->placar_fora,
                ];
            }

            $carrinho->apostas_formatadas = $final;
            $carrinho->acertos = $acertos;
        }

        return view('Paginas.User.BilheteUsuario', compact('bilhetes'));
    }
}
