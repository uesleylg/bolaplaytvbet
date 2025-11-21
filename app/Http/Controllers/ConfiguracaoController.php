<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao;
use App\Models\Slide;

class ConfiguracaoController extends Controller
{
    public function index()
    {
       
        $slides = Slide::orderBy('ordem')->get();

        return view('Paginas.Admin.configuracao', compact('slides'));
    }

public function salvar(Request $request)
{
    foreach ($request->except('_token') as $chave => $valor) {

        // Verifica se o campo é um arquivo
        if ($request->hasFile($chave)) {

            // Validação correta para aceitar favicon, logos e ícones
            $request->validate([
                $chave => 'mimes:jpeg,png,jpg,gif,svg,ico|max:4096'
            ]);

            // Pasta dedicada
            $pasta = 'logos';

            // Remove arquivo antigo
            $configAntiga = Configuracao::where('chave', $chave)->first();
            if ($configAntiga && $configAntiga->valor && \Storage::disk('public')->exists($configAntiga->valor)) {
                \Storage::disk('public')->delete($configAntiga->valor);
            }

            // Gera nome único e trata espaços
            $nomeOriginal = $request->file($chave)->getClientOriginalName();
            $nomeTratado = preg_replace('/\s+/', '_', $nomeOriginal); 
            $nomeArquivo = uniqid() . '_' . $nomeTratado;

            $path = $request->file($chave)->storeAs($pasta, $nomeArquivo, 'public');

            // Salva ou atualiza no banco
            Configuracao::updateOrCreate(
                ['chave' => $chave],
                ['valor' => $path]
            );

        } else {

            // Salva valores simples
            Configuracao::updateOrCreate(
                ['chave' => $chave],
                ['valor' => $valor]
            );
        }
    }

    return back()->with('success', 'Configurações salvas com sucesso!');
}


public function excluir(Request $request)
{
    // Validação simples
    $request->validate([
        'chave' => 'required|string'
    ]);

    // Busca a configuração correspondente à chave
    $config = Configuracao::where('chave', $request->chave)->first();

    if($config && $config->valor) {
        // Verifica se o arquivo existe e deleta
        if (\Storage::disk('public')->exists($config->valor)) {
            \Storage::disk('public')->delete($config->valor);
        }

        // Remove o valor no banco
        $config->valor = null;
        $config->save();
    }

    // Retorna resposta JSON para o AJAX
    return response()->json(['success' => true]);
}



}
