<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meta;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Quantidade de pessoas indicadas pelo usuário
        $indicados = User::where('referencia_id', $user->id)->count();

        // Busca todas metas cadastradas no banco
        $metas = Meta::orderBy('nivel', 'asc')->get();

        // Calcula progresso para cada meta
        foreach ($metas as $meta) {

            // Progresso percentual
            $meta->progresso = min(100, ($indicados / $meta->quantidade_indicados) * 100);

            // Se atingiu a meta
            $meta->atingido = $indicados >= $meta->quantidade_indicados;

        }

        return view('Paginas.User.indicacao', compact('metas', 'indicados'));
    }
}
