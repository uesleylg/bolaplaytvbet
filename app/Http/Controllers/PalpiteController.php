<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilhete;
use App\Models\Palpite;
use App\Models\Rodada;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PalpiteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rodada_id' => 'required|exists:rodadas,id',
            'palpites' => 'required|array|min:1',
            'palpites.*.rodada_jogo_id' => 'required|exists:rodada_jogos,id',
            'palpites.*.escolha' => 'required|in:casa,empate,fora'
        ]);

        DB::beginTransaction();

        try {
            // Pega a rodada para obter o valor do bilhete
            $rodada = Rodada::findOrFail($request->rodada_id);

            // Gera código único para o bilhete
            $codigoBilhete = strtoupper(Str::random(10));

            // Cria o bilhete
            $bilhete = Bilhete::create([
                'rodada_id' => $rodada->id,
                'usuario_id' => Auth::id(),
                'codigo_bilhete' => $codigoBilhete,
                'valor_aposta' => $rodada->valor_bilhete,
                'status' => 'aberto'
            ]);

            // Cria os palpites individuais
            foreach ($request->palpites as $p) {
                Palpite::create([
                    'bilhete_id' => $bilhete->id,
                    'rodada_jogo_id' => $p['rodada_jogo_id'],
                    'escolha' => $p['escolha']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'palpite_id' => $bilhete->id,
                'codigo_bilhete' => $bilhete->codigo_bilhete
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erro ao registrar bilhete e palpites: ' . $e->getMessage()
            ], 500);
        }
    }
}
