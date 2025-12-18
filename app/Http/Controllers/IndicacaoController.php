<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\Indicacao;
use App\Models\ResgateMeta;
use App\Models\Saque;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 🔹 Histórico de pedidos de saque do usuário
        $saques = Saque::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        // 🔹 Lista de indicados com status
     $indicadosLista = Indicacao::with('indicado')
    ->where('indicador_id', $user->id)
    ->orderByDesc('created_at')
    ->get()
    ->map(function ($registro) {
        // Define o modo: se não comprou, 'aguardando', senão mantém 'primeira' ou 'recorrente'
        $modo = $registro->bilhete_id ? $registro->status : 'aguardando';

        return (object)[
            'nome_indicado' => $registro->indicado->name ?? '—',
            'modo' => $modo,
            'resgatado' => $registro->resgatado,
            'created_at' => $registro->created_at,
        ];
    });


        // 🔹 Contagem de indicados válidos por tipo (não resgatados)
        $indicadosPrimeira = Indicacao::where('indicador_id', $user->id)
            ->where('status', 'primeira')
            ->where('resgatado', 0) // <-- só conta quem ainda não resgatou
            ->count();

        $indicadosRecorrente = Indicacao::where('indicador_id', $user->id)
            ->where('status', 'recorrente')
            ->where('resgatado', 0) // <-- só conta quem ainda não resgatou
            ->count();

        // 🔹 Carrega metas e progresso
        $metas_primeira = Meta::where('modo', 'primeira')
            ->orderBy('nivel')
            ->get()
            ->map(function ($meta) use ($indicadosPrimeira) {
                $meta->progresso = min(100, ($indicadosPrimeira / $meta->quantidade_indicados) * 100);
                $meta->atingido = $indicadosPrimeira >= $meta->quantidade_indicados;
                return $meta;
            });

        $metas_recorrencia = Meta::where('modo', 'recorrente')
            ->orderBy('nivel')
            ->get()
            ->map(function ($meta) use ($indicadosRecorrente) {
                $meta->progresso = min(100, ($indicadosRecorrente / $meta->quantidade_indicados) * 100);
                $meta->atingido = $indicadosRecorrente >= $meta->quantidade_indicados;
                return $meta;
            });

        // 🔹 Histórico de resgates do usuário
        $resgates = ResgateMeta::with('meta')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('Paginas.User.indicacao', compact(
            'metas_primeira',
            'metas_recorrencia',
            'indicadosPrimeira',
            'indicadosRecorrente',
            'indicadosLista',
            'resgates',
            'saques'
        ));
    }
}
