<?php

namespace App\Http\Controllers;

use App\Models\ResgateMeta;
use App\Models\Indicacao;
use App\Models\Meta;
use App\Models\Carteira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResgateMetaController extends Controller
{
    public function resgatar(Request $request, $meta_id)
    {
        $user = auth()->user();
        $meta = Meta::findOrFail($meta_id);

        // 🔹 Pega todos os indicados válidos (não resgatados)
        $indicadosValidos = Indicacao::where('indicador_id', $user->id)
            ->where('resgatado', 0) // apenas indicados ainda não resgatados
            ->where(function($q) use ($meta) {
                if ($meta->modo === 'primeira') {
                    $q->where('status', 'primeira'); // apenas primeira compra
                } elseif ($meta->modo === 'recorrente') {
                    $q->where('status', 'recorrente'); // apenas recorrentes
                }
            })
            ->with('indicado')
            ->get();

        // 🔹 Verifica se há indicados suficientes
        if ($indicadosValidos->count() < $meta->quantidade_indicados) {
            return response()->json([
                'success' => false,
                'message' => "Você não possui indicados suficientes para essa meta."
            ]);
        }

        // 🔹 Cria o resgate, marca indicados como resgatados e adiciona bônus na carteira
        DB::transaction(function () use ($user, $meta, $indicadosValidos) {
            // 1️⃣ Cria o registro de resgate
            $resgate = ResgateMeta::create([
                'user_id' => $user->id,
                'meta_id' => $meta->id,
                'valor_bonus' => $meta->bonus_valor,
                'status' => 'Aprovado',
            ]);

            // 2️⃣ Marca os indicados utilizados como resgatados
            $indicadosParaUsar = $indicadosValidos->take($meta->quantidade_indicados);
            foreach ($indicadosParaUsar as $indicado) {
                $indicado->update([
                    'resgatado' => 1
                ]);
            }

            // 3️⃣ Atualiza ou cria a carteira do usuário
            $carteira = Carteira::firstOrCreate(
                ['usuario_id' => $user->id],
                ['saldo' => 0] // cria com saldo 0 se não existir
            );

            // Incrementa o saldo com o valor do bônus
            $carteira->increment('saldo', $meta->bonus_valor);
        });

        return response()->json([
            'success' => true,
            'message' => "Meta resgatada com sucesso! Bônus adicionado à sua carteira."
        ]);
    }
}
