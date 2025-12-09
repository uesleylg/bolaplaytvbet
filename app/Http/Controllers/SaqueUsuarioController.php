<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saque;
use App\Models\Configuracao;

class SaqueUsuarioController extends Controller
{
    public function solicitar(Request $request)
    {
        $user = auth()->user();

        // PEGAR LIMITE CONFIGURADO NO PAINEL ADMIN
        $limiteMinimo = Configuracao::get('limite_saque', 20);

        $request->validate([
            'valor' => "required|numeric|min:$limiteMinimo",
            'chavePix' => 'required|string|min:3|max:255',
        ]);

        // VERIFICAR SE TEM CARTEIRA
        if (!$user->carteira) {
            return response()->json([
                'success' => false,
                'message' => 'Carteira não encontrada.'
            ]);
        }

        $saldo = $user->carteira->saldo;

        // SALDO SUFICIENTE?
        if ($request->valor > $saldo) {
            return response()->json([
                'success' => false,
                'message' => 'Saldo insuficiente para realizar o saque.'
            ]);
        }

        // 🔥 CRIAR SAQUE
        $saque = Saque::create([
            'user_id' => $user->id,
            'valor'   => $request->valor,
            'chave_pix' => $request->chavePix,
            'status'  => 'Pendente',
        ]);

        // 🔥 DESCONTAR DO SALDO
        $user->carteira->decrement('saldo', $request->valor);

        return response()->json([
            'success' => true,
            'message' => 'Saque solicitado com sucesso!',
            'saque_id' => $saque->id
        ]);
    }
}
