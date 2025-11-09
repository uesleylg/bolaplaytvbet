<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RodadaJogo;
use App\Models\Rodada;

class RodadaJogoController extends Controller
{
    /**
     * Cadastrar um novo jogo de rodada
     */
    public function store(Request $request)
    {
        $jogos = $request->all();

        if (empty($jogos)) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum jogo enviado.'
            ], 422);
        }

        // Pega a rodada do primeiro jogo
        $rodada_id = $jogos[0]['rodada_id'] ?? null;
        $rodada = Rodada::find($rodada_id);

        if (!$rodada) {
            return response()->json([
                'success' => false,
                'message' => 'Rodada não encontrada.'
            ], 422);
        }

        // Verifica se a rodada já está ativa
        if ($rodada->status === 'Ativo') {
            return response()->json([
                'success' => false,
                'message' => 'Não é possível cadastrar jogos, a rodada já está ativa.'
            ], 422);
        }

        // Checa se a quantidade de jogos enviados mais os já cadastrados ultrapassa num_palpites
        $jogosExistentes = RodadaJogo::where('rodada_id', $rodada_id)->count();
        $totalEnviado = count($jogos);
        $totalApósEnvio = $jogosExistentes + $totalEnviado;

        if ($totalApósEnvio > $rodada->num_palpites) {
            return response()->json([
                'success' => false,
                'message' => "Você não pode cadastrar mais de {$rodada->num_palpites} jogos nesta rodada. Já existem {$jogosExistentes} cadastrados."
            ], 422);
        }

        // Agora verifica se está enviando exatamente a quantidade necessária para completar a rodada
        if ($totalApósEnvio < $rodada->num_palpites) {
            $faltam = $rodada->num_palpites - $jogosExistentes;
            return response()->json([
                'success' => false,
                'message' => "Você precisa selecionar exatamente {$faltam} jogos para completar esta rodada."
            ], 422);
        }

        // Validação dos campos
        $validator = Validator::make($jogos, [
            '*.rodada_id' => 'required|exists:rodadas,id',
            '*.id_partida' => 'required|string|max:255',
            '*.time_casa_nome' => 'required|string|max:255',
            '*.time_fora_nome' => 'required|string|max:255',
            '*.data_jogo' => 'required|date',
            '*.competicao' => 'nullable|string|max:255',
            '*.time_casa_brasao' => 'nullable|string|max:255',
            '*.time_fora_brasao' => 'nullable|string|max:255',
        ], [
            '*.rodada_id.required' => 'O ID da rodada é obrigatório.',
            '*.rodada_id.exists' => 'A rodada informada não existe.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $validated = $validator->validated();

        // Checa duplicidade de jogos na mesma rodada
        foreach ($validated as $jogo) {
            $exists = RodadaJogo::where('rodada_id', $jogo['rodada_id'])
                        ->where('id_partida', $jogo['id_partida'])
                        ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => "O jogo {$jogo['time_casa_nome']} vs {$jogo['time_fora_nome']} já está cadastrado nesta rodada."
                ], 422);
            }
        }

        // Cria os jogos
        foreach ($validated as $jogo) {
            RodadaJogo::create($jogo);
        }

        // Atualiza o status da rodada para Ativo
        $rodada->status = 'Ativo';
        $rodada->save();

        return response()->json([
            'success' => true,
            'message' => 'Jogos cadastrados com sucesso! A rodada agora está ativa.'
        ]);
    }
}
