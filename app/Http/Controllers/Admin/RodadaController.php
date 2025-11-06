<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Rodada;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class RodadaController extends Controller
{
    // 🏁 Lista todas as rodadas
    public function index()
    {
       $rodadas = Rodada::orderBy('id', 'desc')->get()->map(function ($rodada) {
        $rodada->data_inicio_formatada = Carbon::parse($rodada->data_inicio)->format('d/m/Y H:i');
        $rodada->data_fim_formatada = Carbon::parse($rodada->data_fim)->format('d/m/Y H:i');
        $rodada->premiacao_texto = 'R$' . number_format($rodada->premiacao_estimada, 2, ',', '.');
        return $rodada;
    });

          return view('Admin.rodada', compact('rodadas'));
    }




public function store(Request $request)
    {
     

        $validator = Validator::make($request->all(), [
          
            'nome' => [
                'required',
                'string',
                'max:100',
                'unique:rodadas,nome',
            ],
            'valorBilhete' => [
                'required',
                'numeric',
                'min:0',
            ],
            'premiacaoEstimada' => [
                'required',
                'numeric',
                'min:0',
            ],
            'descricao' => [
                'nullable',
                'string',
                'max:2000',
            ],
            'dataInicio' => [
                'required',
                'date',
            ],
            'dataEncerramento' => [
                'required',
                'date',
                'after_or_equal:dataInicio',
            ],
            'modoJogo' => [
                'required',
                'in:padrao,predefinido',
            ],
            'numPalpites' => [
                'required',
                'integer',
                'min:1',
            ],
             'permite_multiplas' => [
                'nullable',
                'boolean'
            ],
        ], [
            'nome.required' => 'O nome da rodada é obrigatório.',
            'nome.unique' => 'Já existe uma rodada com esse nome.',
            'valorBilhete.required' => 'O valor do bilhete é obrigatório.',
            'valorBilhete.numeric' => 'O valor do bilhete deve ser numérico.',
            'premiacaoEstimada.required' => 'A premiação estimada é obrigatória.',
            'premiacaoEstimada.numeric' => 'A premiação estimada deve ser numérica.',
            'dataInicio.required' => 'A data de início é obrigatória.',
            'dataInicio.date' => 'A data de início deve ser válida.',
            'dataEncerramento.required' => 'A data de encerramento é obrigatória.',
            'dataEncerramento.date' => 'A data de encerramento deve ser válida.',
            'dataEncerramento.after_or_equal' => 'A data de encerramento deve ser posterior ou igual à data de início.',
            'modoJogo.required' => 'O modo de jogo é obrigatório.',
            'modoJogo.in' => 'O modo de jogo selecionado é inválido.',
            'numPalpites.required' => 'O número de palpites é obrigatório.',
            'numPalpites.integer' => 'O número de palpites deve ser um número inteiro.',
            'numPalpites.min' => 'O número de palpites deve ser pelo menos 1.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // primeira mensagem de erro
            ], 422);
        }
        
        $validated = $validator->validated();

        // Cria a rodada
    $rodada = Rodada::create([
    'nome' => $validated['nome'],
    'valor_bilhete' => $validated['valorBilhete'],
    'premiacao_estimada' => $validated['premiacaoEstimada'],
    'descricao' => $validated['descricao'] ?? null,
    'data_inicio' => $validated['dataInicio'],
    'data_fim' => $validated['dataEncerramento'],
    'modo' => $validated['modoJogo'],
    'num_palpites' => $validated['numPalpites'],
    'status' => 'Pendente',
    'multiplas' => $request->input('permite_multiplas') ? 1 : 0,







]);


        return response()->json([
            'success' => true,
            'message' => 'Rodada cadastrada com sucesso!',
            'rodada' => $rodada,
        ]);
    }

 

    // 🚀 Atualizar
  public function update(Request $request, $id)
{
    // Busca a rodada
    $rodada = Rodada::find($id);

    if (!$rodada) {
        return response()->json([
            'success' => false,
            'message' => 'Rodada não encontrada.',
        ], 404);
    }

    // Validação
    $validator = Validator::make($request->all(), [
        'nome' => [
            'required',
            'string',
            'max:100',
            Rule::unique('rodadas', 'nome')->ignore($rodada->id),
        ],
        'valorBilhete' => [
            'required',
            'numeric',
            'min:0',
        ],
        'premiacaoEstimada' => [
            'required',
            'numeric',
            'min:0',
        ],
        'descricao' => [
            'nullable',
            'string',
            'max:2000',
        ],
        'dataInicio' => [
            'required',
            'date',
        ],
        'dataEncerramento' => [
            'required',
            'date',
            'after_or_equal:dataInicio',
        ],
        'modoJogo' => [
            'required',
            'in:padrao,predefinido',
        ],
        'numPalpites' => [
            'required',
            'integer',
            'min:1',
        ],
        'permite_multiplas' => [
            'nullable',
            'boolean'
        ],
    ], [
        'nome.required' => 'O nome da rodada é obrigatório.',
        'nome.unique' => 'Já existe uma rodada com esse nome.',
        'valorBilhete.required' => 'O valor do bilhete é obrigatório.',
        'valorBilhete.numeric' => 'O valor do bilhete deve ser numérico.',
        'premiacaoEstimada.required' => 'A premiação estimada é obrigatória.',
        'premiacaoEstimada.numeric' => 'A premiação estimada deve ser numérica.',
        'dataInicio.required' => 'A data de início é obrigatória.',
        'dataInicio.date' => 'A data de início deve ser válida.',
        'dataEncerramento.required' => 'A data de encerramento é obrigatória.',
        'dataEncerramento.date' => 'A data de encerramento deve ser válida.',
        'dataEncerramento.after_or_equal' => 'A data de encerramento deve ser posterior ou igual à data de início.',
        'modoJogo.required' => 'O modo de jogo é obrigatório.',
        'modoJogo.in' => 'O modo de jogo selecionado é inválido.',
        'numPalpites.required' => 'O número de palpites é obrigatório.',
        'numPalpites.integer' => 'O número de palpites deve ser um número inteiro.',
        'numPalpites.min' => 'O número de palpites deve ser pelo menos 1.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 422);
    }

    $validated = $validator->validated();

    // Atualiza a rodada
    $rodada->update([
        'nome' => $validated['nome'],
        'valor_bilhete' => $validated['valorBilhete'],
        'premiacao_estimada' => $validated['premiacaoEstimada'],
        'descricao' => $validated['descricao'] ?? null,
        'data_inicio' => $validated['dataInicio'],
        'data_fim' => $validated['dataEncerramento'],
        'modo' => $validated['modoJogo'],
        'num_palpites' => $validated['numPalpites'],
        'multiplas' => $request->boolean('permite_multiplas') ? 1 : 0,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Rodada atualizada com sucesso!',
        'rodada' => $rodada,
    ]);
}


    // 🗑️ Deletar rodada
public function destroy($id)
{
    $rodada = Rodada::findOrFail($id);
    $rodada->delete();

    return redirect()->back()->with('success', 'Rodada excluída com sucesso!');
}

}
