<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rodada;
use App\Models\Jogo;

class RodadaController extends Controller
{
    // 🏁 Lista todas as rodadas
    public function index()
    {
        $rodadas = Rodada::orderBy('id', 'desc')->get();
        return view('rodadas.index', compact('rodadas'));
    }

    // ➕ Formulário de criação
    public function create()
    {
        return view('Admin.rodada');
    }

    // 💾 Salvar nova rodada com os jogos
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'premio' => 'required|string|max:150',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'jogos' => 'required|array|min:8|max:8',
        ]);

        // Cria a rodada
        $rodada = Rodada::create([
            'nome' => $request->nome,
            'premio' => $request->premio,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'status' => 'aberta'
        ]);

        // Cadastra os 8 jogos
        foreach ($request->jogos as $jogo) {
            Jogo::create([
                'rodada_id' => $rodada->id,
                'mandante' => $jogo['mandante'],
                'visitante' => $jogo['visitante'],
                'data_jogo' => $jogo['data_jogo'],
            ]);
        }

        return redirect()->route('rodadas.index')->with('success', 'Rodada criada com sucesso!');
    }

    // ✏️ Editar rodada (se quiser)
    public function edit($id)
    {
        $rodada = Rodada::findOrFail($id);
        return view('rodadas.edit', compact('rodada'));
    }

    // 🚀 Atualizar
    public function update(Request $request, $id)
    {
        $rodada = Rodada::findOrFail($id);

        $rodada->update($request->only(['nome', 'premio', 'data_inicio', 'data_fim', 'status']));

        return redirect()->route('rodadas.index')->with('success', 'Rodada atualizada com sucesso!');
    }

    // 🗑️ Deletar rodada
    public function destroy($id)
    {
        $rodada = Rodada::findOrFail($id);
        $rodada->delete();

        return redirect()->route('rodadas.index')->with('success', 'Rodada excluída!');
    }
}
