<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Bilhete;
use App\Models\CarrinhoPalpite;
use App\Models\RodadaJogo;

class BilheteController extends Controller
{
    public function index(Request $request)
    {
        // ======= ESTATÍSTICAS =======
        $totalBilhetes   = Bilhete::count();
        $totalAbertos    = Bilhete::where('status', 'aberto')->count();
        $totalGanhos     = Bilhete::where('status', 'ganho')->count();
        $totalPerdidos   = Bilhete::where('status', 'perdido')->count();
        $totalCancelados = Bilhete::where('status', 'cancelado')->count();

        // ======= FILTROS =======
        $query = Bilhete::query()->with('carrinho.usuario');

        if ($request->filled('busca')) {
            $query->where('codigo_bilhete', 'like', "%{$request->busca}%")
                  ->orWhere('id', $request->busca);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('carrinho')) {
            $query->where('carrinho_id', $request->carrinho);
        }

        if ($request->filled('recentes')) {
            if ($request->recentes == 'hoje') {
                $query->whereDate('created_at', now()->toDateString());
            } else {
                $dias = (int) $request->recentes;
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }

        // ======= RESULTADO FINAL =======
        $bilhetes = $query->orderBy('id', 'desc')->paginate(20);

        // ======= APOSTAS FORMATADAS POR BILHETE =======
        foreach ($bilhetes as $bilhete) {

            $carrinho = $bilhete->carrinho;

            // Se carrinho incompleto → pula
            if (!$carrinho || !$carrinho->rodada_id || !$carrinho->combinacoes_compactadas) {
                $bilhete->apostas_formatadas = [];
                continue;
            }

            // Buscar todos os jogos da rodada
            $jogos = RodadaJogo::where('rodada_id', $carrinho->rodada_id)->get();
            if ($jogos->isEmpty()) {
                $bilhete->apostas_formatadas = [];
                continue;
            }

            // Apostas: "1-x-2-x-1"
            $apostas = explode('-', $carrinho->combinacoes_compactadas);

            $final = [];

            foreach ($jogos as $i => $jogo) {

                $aposta = $apostas[$i] ?? null;

                // Ícone e Cor conforme seleção
                $icon = '';
                $color = '';

                if ($aposta == "1") {
                    $icon = 'fa-solid fa-house';
                    $color = '#1976d2';
                } elseif ($aposta == "x") {
                    $icon = 'fa-solid fa-xmark';
                    $color = '#ff9800';
                } elseif ($aposta == "2") {
                    $icon = 'fa-solid fa-plane';
                    $color = '#388e3c';
                }

                // ============================
                // CALCULAR STATUS DA APOSTA
                // ============================

                // Possível valores: casa / empate / fora
                $resultado = $jogo->resultado_real;

                $status = "pendente"; // padrão

                if ($resultado) {

                    if ($aposta == "1" && $resultado == "casa") {
                        $status = "acertou";
                    } elseif ($aposta == "x" && $resultado == "empate") {
                        $status = "acertou";
                    } elseif ($aposta == "2" && $resultado == "fora") {
                        $status = "acertou";
                    } else {
                        $status = "errou";
                    }
                }

                // Montar array final
                $final[] = [
                    'time_casa'  => $jogo->time_casa_nome,
                    'time_fora'  => $jogo->time_fora_nome,
                    'aposta'     => $aposta,
                    'icon'       => $icon,
                    'iconColor'  => $color,

                    // resultado real do jogo
                    'resultado'  => $resultado,

                    // novo campo
                    'status'     => $status,
                ];
            }

            $bilhete->apostas_formatadas = $final;
        }

        // Carrinhos para filtro
        $carrinhos = CarrinhoPalpite::select('id')->get();

        return view('Paginas.Admin.bilhete', compact(
            'bilhetes',
            'carrinhos',
            'totalBilhetes',
            'totalAbertos',
            'totalGanhos',
            'totalPerdidos',
            'totalCancelados'
        ));
    }
}
