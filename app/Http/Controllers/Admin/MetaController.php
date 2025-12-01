<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta;

class MetaController extends Controller
{
public function index(Request $request)
{
    // Parâmetros opcionais da URL
    $filtroNivel = $request->input('nivel');
    $busca = $request->input('busca');

    // Query base
    $query = Meta::query();

    // Filtro por nível
    if (!empty($filtroNivel)) {
        $query->where('nivel', $filtroNivel);
    }

    // Busca por título ou descrição
    if (!empty($busca)) {
        $query->where(function($q) use ($busca) {
            $q->where('titulo', 'like', "%{$busca}%")
              ->orWhere('descricao', 'like', "%{$busca}%");
        });
    }

    // Ordenação sempre por nível
    $query->orderBy('nivel', 'asc');

    // Paginação
    $metas = $query->paginate(10)->appends($request->query());

    return view('Paginas.Admin.metas', compact('metas', 'filtroNivel', 'busca'));
}



  public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'nivel' => 'required|integer|unique:metas,nivel',
        'descricao' => 'required|string|max:255',
        'quantidade_indicados' => 'required|integer',
        'bonus_valor' => 'required|numeric',
        'status' => 'required|in:Ativo,Inativo',
    ]);

    $meta = Meta::create([
        'titulo' => $request->titulo,
        'nivel' => $request->nivel,
        'descricao' => $request->descricao,
        'quantidade_indicados' => $request->quantidade_indicados,
        'bonus_valor' => $request->bonus_valor,
        'status' => $request->status,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Meta cadastrada com sucesso!',
        'data' => $meta
    ]);
}

public function destroy($id)
{
    $meta = Meta::find($id);

    if (!$meta) {
        return response()->json([
            'success' => false,
            'message' => 'Meta não encontrada.'
        ], 404);
    }

    $meta->delete();

    return response()->json([
        'success' => true,
        'message' => 'Meta excluída com sucesso!'
    ]);
}

public function update(Request $request, $id)
{
    $meta = Meta::findOrFail($id);

    $request->validate([
        'nivel' => 'required|integer|unique:metas,nivel,' . $id,
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'quantidade_indicados' => 'required|integer',
        'bonus_valor' => 'required|numeric',
        'status' => 'required|in:Ativo,Inativo',
    ]);

    $meta->update($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Meta atualizada com sucesso!',
    ]);
}

public function show($id)
{
    $meta = Meta::findOrFail($id);

    return response()->json([
        'success' => true,
        'data' => $meta
    ]);
}



}
