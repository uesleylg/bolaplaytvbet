<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\IndicacaoUtilizada;
use App\Models\ResgateMeta;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 🔹 Lista de indicados com status
        $indicadosLista = IndicacaoUtilizada::with('indicado')
            ->where('indicador_id', $user->id)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($registro) {
                $registro->nome_indicado = $registro->indicado->name ?? '—';
                $registro->status_indicacao = match($registro->status) {
                    'ativo' => 'aguardando_validacao',
                    'resgatado' => 'aprovado',
                    default => 'pendente',
                };
                return $registro;
            });

        // 🔹 Contagem de indicados válidos
        $indicados = IndicacaoUtilizada::where('indicador_id', $user->id)
            ->where('status', 'ativo')
            ->count();

        // 🔹 Carrega metas e progresso
        $metas = Meta::orderBy('nivel')
            ->get()
            ->map(function ($meta) use ($indicados) {
                $meta->progresso = min(100, ($indicados / $meta->quantidade_indicados) * 100);
                $meta->atingido = $indicados >= $meta->quantidade_indicados;
                return $meta;
            });

        // 🔹 Histórico de resgates do usuário
        $resgates = ResgateMeta::with('meta')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('Paginas.User.indicacao', compact('metas', 'indicados', 'indicadosLista', 'resgates'));
    }
}
