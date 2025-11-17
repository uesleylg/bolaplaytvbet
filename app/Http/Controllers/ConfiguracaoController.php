<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        // carrega todas configurações do banco como array chave => valor
        $configs = Configuracao::pluck('valor', 'chave')->toArray();

        return view('Paginas.Admin.configuracao', compact('configs'));
    }

    public function salvar(Request $request)
    {
        foreach ($request->except('_token') as $chave => $valor) {
            Configuracao::updateOrCreate(
                ['chave' => $chave],
                ['valor' => $valor]
            );
        }

        return back()->with('success', 'Configurações salvas com sucesso!');
    }
}
