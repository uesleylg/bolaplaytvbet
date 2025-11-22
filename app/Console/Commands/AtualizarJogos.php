<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RodadaJogo;

class AtualizarJogos extends Command
{
    protected $signature = 'atualizar:jogos';
    protected $description = 'Atualiza status, resultado lógico e placar dos jogos via Flashscore';

    public function handle()
    {
        // Busca jogos que ainda não foram finalizados
        $jogos = RodadaJogo::whereIn('status_jogo', ['aguardando', 'em_andamento'])->get();

        foreach ($jogos as $jogo) {
            $this->info("Atualizando jogo: {$jogo->time_casa_nome} x {$jogo->time_fora_nome}");

            $resultado = $this->extract_match_status($jogo->id_partida);

            // Mapeamento do status da API para o status_jogo do banco
            $status_map = [
                "Não iniciado" => "aguardando",
                "Ao vivo"      => "em_andamento",
                "Encerrado"    => "finalizado",
            ];

            $jogo->status_jogo = $status_map[$resultado['status']] ?? $jogo->status_jogo;

            // Inicializa campos de placar e resultado lógico
            $jogo->placar_casa = null;
            $jogo->placar_fora = null;
            $jogo->resultado_real = null;

            // Se o jogo tiver gols, preenche placar e resultado lógico
            if (!is_null($resultado['home_goals']) && !is_null($resultado['away_goals'])) {
                $jogo->placar_casa = $resultado['home_goals'];
                $jogo->placar_fora = $resultado['away_goals'];

                if ($resultado['home_goals'] > $resultado['away_goals']) {
                    $jogo->resultado_real = 'casa';
                } elseif ($resultado['home_goals'] < $resultado['away_goals']) {
                    $jogo->resultado_real = 'fora';
                } else {
                    $jogo->resultado_real = 'empate';
                }
            }

            $jogo->save();

            $this->info("Atualizado: Status = {$jogo->status_jogo}, Resultado = {$jogo->resultado_real}, Placar = {$jogo->placar_casa} x {$jogo->placar_fora}");
        }

        $this->info("Todos os jogos foram atualizados!");
    }

    private function extract_match_status($event_id)
    {
        $headers = [
            "x-fsign: SW9D1eZo",
            "origin: https://www.flashscore.com.br",
            "accept: */*",
            "user-agent: Mozilla/5.0"
        ];

        // Feed principal
        $url_main = "https://global.flashscore.ninja/401/x/feed/dc_1_" . $event_id;
        $feed_main = $this->curl_get($url_main, $headers);

        $home_goals = preg_match('/DE÷(\d+)¬/', $feed_main, $matches) ? (int)$matches[1] : null;
        $away_goals = preg_match('/DF÷(\d+)¬/', $feed_main, $matches) ? (int)$matches[1] : null;

        $status_map = ["1" => "Não iniciado", "2" => "Ao vivo", "3" => "Encerrado"];
        $status = preg_match('/DA÷(\d+)¬/', $feed_main, $matches) ? ($status_map[$matches[1]] ?? "Desconhecido") : "Desconhecido";

        $minute = null;
        $current_half = null;

        // Se o jogo estiver ao vivo, tenta pegar o minuto atual e período
        if ($status === "Ao vivo") {
            $url_events = "https://global.flashscore.ninja/401/x/feed/df_sui_1_" . $event_id;
            $feed_events = $this->curl_get($url_events, $headers);

            if (preg_match_all('/AC÷(.*?)¬/', $feed_events, $halves_matches)) {
                $halves = $halves_matches[1];
                $current_half = end($halves);

                $pattern = '/AC÷' . preg_quote($current_half, '/') . '¬.*?IB÷(\d+)\'/s';
                if (preg_match_all($pattern, $feed_events, $event_matches)) {
                    $minute = end($event_matches[1]) . "'";
                }
            }
        }

        return [
            "home_goals" => $home_goals,
            "away_goals" => $away_goals,
            "status" => $status,
            "minute" => $minute,
            "half" => $current_half
        ];
    }

    private function curl_get($url, $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
