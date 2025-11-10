<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palpite;
use App\Models\Rodada;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PalpiteController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validação mínima
            $request->validate([
                'rodada_id' => 'required|integer|exists:rodadas,id',
            ]);

            // Busca a rodada para pegar o valor do bilhete
            $rodada = Rodada::findOrFail($request->rodada_id);
            $valorBilhete = $rodada->valor_bilhete;

            // Gera código do bilhete único
            do {
                $codigoBilhete = Str::upper(Str::random(10));
            } while (Palpite::where('codigo_bilhete', $codigoBilhete)->exists());

            // Cria o bilhete na tabela palpites
            $palpite = Palpite::create([
                'rodada_id' => $rodada->id,
                'usuario_id' => Auth::id(),
                'codigo_bilhete' => $codigoBilhete,
                'valor_aposta' => $valorBilhete,
                'status' => 'aberto',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bilhete registrado com sucesso!',
                'codigo_bilhete' => $codigoBilhete,
                'palpite_id' => $palpite->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao registrar bilhete',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}




