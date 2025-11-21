<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Rodada;
use App\Models\RodadaJogo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class RodadaController extends Controller
{

public function excluirJogos($rodadaId)
{
    try {

        // 1️⃣ Excluir todos os jogos desta rodada
        RodadaJogo::where('rodada_id', $rodadaId)->delete();

        // 2️⃣ Atualizar o status da rodada para "Pendente"
        $rodada = Rodada::find($rodadaId);

        if (!$rodada) {
            return response()->json([
                'success' => false,
                'message' => 'Rodada não encontrada.'
            ], 404);
        }

        $rodada->status = 'Pendente';
        $rodada->save();

        return response()->json([
            'success' => true,
            'message' => 'Jogos excluídos e status da rodada atualizado para Pendente.'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Erro ao excluir jogos ou atualizar o status.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function jogos($id)
{
    try {
        $rodada = \App\Models\Rodada::with('jogos')->findOrFail($id);

        return response()->json([
            'success' => true,
            'rodada' => [
                'id' => $rodada->id,
                'nome' => $rodada->nome,
                'modo' => $rodada->modo,
                'status' => $rodada->status,
                'valor_bilhete' => $rodada->valor_bilhete,
                'premiacao_estimada' => $rodada->premiacao_estimada,
                'data_inicio' => $rodada->data_inicio?->format('d/m/Y H:i'),
                'data_fim' => $rodada->data_fim?->format('d/m/Y H:i'),
            ],
            'jogos' => $rodada->jogos->map(function ($jogo) {
                return [
                    'id' => $jogo->id,
                    'id_partida' => $jogo->id_partida,
                    'time_casa_nome' => $jogo->time_casa_nome,
                    'time_fora_nome' => $jogo->time_fora_nome,
                    'time_casa_brasao' => $jogo->time_casa_brasao,
                    'time_fora_brasao' => $jogo->time_fora_brasao,
                    'data_jogo' => $jogo->data_jogo?->format('d/m/Y H:i'),
                    'competicao' => $jogo->competicao,
                    'status_jogo' => $jogo->status_jogo,
                    'resultado_real' => $jogo->resultado_real,

                    // 👉 AQUI ESTAVA FALTANDO
                    'link_jogo' => $jogo->link_jogo,
                ];
            }),
        ]);
    } catch (\Exception $e) {
        \Log::error('Erro ao buscar jogos da rodada: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Erro ao carregar os jogos da rodada.',
        ], 500);
    }
}






    // 🏁 Lista todas as rodadas
public function index(Request $request)
{
    $query = Rodada::query();

    // FILTRO: busca por ID ou nome
    if ($request->filled('busca')) {
        $busca = $request->busca;

        $query->where(function ($q) use ($busca) {
            $q->where('id', $busca)
              ->orWhere('nome', 'like', "%$busca%");
        });
    }

    // FILTRO: status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // FILTRO: ordenação
    if ($request->ordenar == 'recentes') {
        $query->orderBy('id', 'desc');
    } elseif ($request->ordenar == 'antigos') {
        $query->orderBy('id', 'asc');
    } else {
        $query->orderBy('id', 'desc'); // padrão
    }

    // busca final
    $rodadas = $query->get()->map(function ($rodada) {
        $rodada->data_inicio_formatada = Carbon::parse($rodada->data_inicio)->format('d/m/Y H:i');
        $rodada->data_fim_formatada = Carbon::parse($rodada->data_fim)->format('d/m/Y H:i');
        $rodada->premiacao_texto = 'R$' . number_format($rodada->premiacao_estimada, 2, ',', '.');
        return $rodada;
    });

    return view('Paginas.Admin.rodada', compact('rodadas'));
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




public function store_auditoria(Request $request)
{
    // Validação (se der erro, Laravel volta automaticamente com os erros)
    $request->validate([
        'rodada_id' => 'required|exists:rodadas,id',
        'link_auditoria' => 'required|url|max:255',
    ]);

    // Busca a rodada
    $rodada = Rodada::findOrFail($request->rodada_id);

    // Atualiza o link
    $rodada->link_auditoria = $request->link_auditoria;
    $rodada->save();

    // Sempre recarrega a página onde estava
    return redirect()->back()->with('success', 'Link de auditoria salvo com sucesso!');
}




}
