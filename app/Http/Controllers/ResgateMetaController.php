<?php

namespace App\Http\Controllers;

use App\Models\ResgateMeta;
use App\Models\IndicacaoUtilizada;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResgateMetaController extends Controller
{
    public function resgatar(Request $request, $meta_id)
    {
        $user = auth()->user();
        $meta = Meta::findOrFail($meta_id);

        // Pega todos os indicados ativos (não resgatados ainda)
        $indicadosValidos = IndicacaoUtilizada::where('indicador_id', $user->id)
            ->where('status', 'ativo') // apenas indicados ativos
            ->with('indicado')
            ->get();

        // Verifica se tem quantidade suficiente para a meta
        if ($indicadosValidos->count() < $meta->quantidade_indicados) {
            return response()->json([
                'success' => false,
                'message' => "Você não possui indicados suficientes para essa meta."
            ]);
        }

        DB::transaction(function () use ($user, $meta, $indicadosValidos) {
            // Cria o resgate
            $resgate = ResgateMeta::create([
                'user_id' => $user->id,
                'meta_id' => $meta->id,
                'valor_bonus' => $meta->bonus_valor,
                'status' => 'Aprovado'
            ]);

            // Marca os indicados como resgatados
            $indicadosParaUsar = $indicadosValidos->take($meta->quantidade_indicados);

            foreach ($indicadosParaUsar as $indicado) {
                $indicado->update([
                    'status' => 'resgatado'
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => "Meta resgatada com sucesso!"
        ]);
    }
}
