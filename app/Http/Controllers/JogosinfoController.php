<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class JogosInfoController extends Controller
{
   private $headers = [
        'x-fsign' => 'SW9D1eZo',
        'origin' => 'https://www.flashscore.com.br'
    ];

    // 🔹 Listar jogos (sem odds)
    public function jogos(Request $request)
    {
        $pais = strtoupper($request->query('pais', 'BRASIL'));
        $dataSelecionada = $request->query('data', date('Y-m-d')); // Data no formato YYYY-MM-DD

        // Calcula diferença de dias entre hoje e a data selecionada
        $hoje = Carbon::today()->startOfDay();
$data = Carbon::createFromFormat('Y-m-d', $dataSelecionada)->startOfDay();
$diffDias = $hoje->diffInDays($data, false);
    
        if ($diffDias < 0) {
            return response()->json(['error' => 'Não é permitido selecionar datas passadas'], 422);
        }

        // Monta a URL do feed com base no índice relativo
        $url = "https://global.flashscore.ninja/401/x/feed/f_1_{$diffDias}_-3_pt-br_1";

        // Faz a requisição ao Flashscore
        $response = Http::withHeaders($this->headers)->get($url);
        $text = $response->body();

        if (empty($text)) {
            return response()->json(['error' => 'Nenhum dado encontrado'], 404);
        }

        $ligas_raw = explode('ZA÷', $text);
        array_shift($ligas_raw);

        $result = [
            'data' => $dataSelecionada,
            'pais' => $pais,
            'ligas' => []
        ];

        foreach ($ligas_raw as $liga_raw) {
            $liga_nome = explode('¬', $liga_raw)[0];

            // Filtra pelo país
            if ($pais && !str_starts_with(strtoupper($liga_nome), $pais)) {
                continue;
            }

            $partidas = explode('~AA÷', $liga_raw);
            array_shift($partidas);

            foreach ($partidas as $part) {
                preg_match('/([^¬]+)/', $part, $id_match);
                if (!$id_match) continue;
                $jogo_id = $id_match[1];

                preg_match('/AD÷(\d+)/', $part, $ts_match);
                if (!$ts_match) continue;

                // Corrige fuso horário
                $ts = (int)$ts_match[1];
                $dataHora = Carbon::createFromTimestamp($ts)->setTimezone('America/Sao_Paulo');
                $data_str = $dataHora->format('Y-m-d');
                $hora_str = $dataHora->format('H:i');

                preg_match('/AE÷([^¬]+)/', $part, $mand);
                preg_match('/AF÷([^¬]+)/', $part, $vist);
                preg_match('/OA÷([^\¬]+)\.png/', $part, $brasao_mand);
                preg_match('/OB÷([^\¬]+)\.png/', $part, $brasao_vist);

                $mand_nome = $mand[1] ?? 'N/A';
                $vist_nome = $vist[1] ?? 'N/A';
                $brasao_mand_link = isset($brasao_mand[1]) ? "https://static.flashscore.com/res/image/data/{$brasao_mand[1]}.png" : null;
                $brasao_vist_link = isset($brasao_vist[1]) ? "https://static.flashscore.com/res/image/data/{$brasao_vist[1]}.png" : null;

                $result['ligas'][$liga_nome][] = [
                    'data' => $data_str,
                    'hora' => $hora_str,
                    'mandante' => $mand_nome,
                    'visitante' => $vist_nome,
                    'id_jogo' => $jogo_id,
                    'imagem_mandante' => $brasao_mand_link,
                    'imagem_visitante' => $brasao_vist_link
                ];
            }
        }

        return response()->json($result);
    }


    // 🔹 Buscar odds por jogo
    public function odds($id)
    {
        $url = "https://global.ds.lsapp.eu/odds/pq_graphql?_hash=ope2&eventId={$id}&bookmakerId=16&betType=HOME_DRAW_AWAY&betScope=FULL_TIME";

        try {
            $response = Http::get($url);
            $data = $response->json();
            $odds_info = $data['data']['findPrematchOddsForBookmaker'] ?? null;

            if (!$odds_info) {
                return response()->json([
                    'id_jogo' => $id,
                    'odds' => [
                        'casa' => null,
                        'empate' => null,
                        'fora' => null
                    ]
                ]);
            }

            return response()->json([
                'id_jogo' => $id,
                'odds' => [
                    'casa' => $odds_info['home']['value'] ?? null,
                    'empate' => $odds_info['draw']['value'] ?? null,
                    'fora' => $odds_info['away']['value'] ?? null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao consultar odds',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 🔹 Buscar placar de um jogo em tempo real
    // 🔹 Buscar placar de um jogo em tempo real com status
public function placar($id)
{
    $url = "https://d.flashscore.com/x/feed/d_st_{$id}_pt-br_1";

    try {
        $response = Http::withHeaders($this->headers)->get($url);
        $texto = $response->body();

        if (empty($texto)) {
            return response()->json(['erro' => 'Nenhum dado de placar encontrado'], 404);
        }

        // Extrai placar
        preg_match('/AA÷(\d+)¬AB÷(\d+)/', $texto, $score);
        $placar_casa = $score[1] ?? null;
        $placar_fora = $score[2] ?? null;

        // Extrai nomes dos times
        preg_match('/AE÷([^¬]+)/', $texto, $mand);
        preg_match('/AF÷([^¬]+)/', $texto, $vist);

        // Extrai status do jogo
        preg_match('/AC÷(\d+)/', $texto, $status); // AC÷ é o código do status
        $status_jogo = 'Não iniciado';
        if (isset($status[1])) {
            switch ($status[1]) {
                case 0: $status_jogo = 'Não iniciado'; break;
                case 1: $status_jogo = '1º tempo'; break;
                case 2: $status_jogo = 'Intervalo'; break;
                case 3: $status_jogo = '2º tempo'; break;
                case 4: $status_jogo = 'Encerrado'; break;
                default: $status_jogo = 'Em andamento';
            }
        }

        return response()->json([
            'id_jogo' => $id,
            'mandante' => $mand[1] ?? 'N/A',
            'visitante' => $vist[1] ?? 'N/A',
            'placar' => [
                'casa' => $placar_casa,
                'fora' => $placar_fora
            ],
            'status' => $status_jogo
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Erro ao buscar placar',
            'mensagem' => $e->getMessage()
        ], 500);
    }
}

}
