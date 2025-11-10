<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palpite;
use App\Models\PalpiteJogo;
use App\Models\Rodada;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PalpiteController extends Controller
{
    public function store(Request $request)
    {
        // Validação mínima
        $request->validate([
            'rodada_id' => 'required|integer|exists:rodadas,id',
            'palpites' => 'required|array',
            'palpites.*.rodada_jogo_id' => 'required|integer|exists:rodada_jogos,id',
            'palpites.*.escolha' => 'required|in:casa,empate,fora',
        ]);

        DB::beginTransaction();

        try {
            // Busca a rodada para pegar o valor do bilhete
            $rodada = Rodada::findOrFail($request->rodada_id);
            $valorBilhete = $rodada->valor_bilhete;

            // Gera código do bilhete único
            do {
                $codigoBilhete = Str::upper(Str::random(10));
            } while (Palpite::where('codigo_bilhete', $codigoBilhete)->exists());

            // Cria o bilhete
            $palpite = Palpite::create([
                'rodada_id' => $rodada->id,
                'usuario_id' => Auth::id(),
                'codigo_bilhete' => $codigoBilhete,
                'valor_aposta' => $valorBilhete,
                'status' => 'aberto',
            ]);

            // Cria os palpites individuais
            foreach ($request->palpites as $p) {
                PalpiteJogo::create([
                    'palpite_id' => $palpite->id,
                    'rodada_jogo_id' => $p['rodada_jogo_id'],
                    'escolha' => $p['escolha'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Bilhete e palpites registrados com sucesso!',
                'codigo_bilhete' => $codigoBilhete,
                'palpite_id' => $palpite->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao registrar bilhete e palpites',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
