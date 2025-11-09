<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RodadaJogo extends Model
{
    use HasFactory;

    // Nome da tabela
    protected $table = 'rodada_jogos';

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'rodada_id',
        'id_partida',
        'time_casa_nome',
        'time_fora_nome',
        'time_casa_brasao',
        'time_fora_brasao',
        'data_jogo',
        'competicao',
        'status_jogo',
        'resultado_real',
    ];

    // Casts automáticos para tipos específicos
    protected $casts = [
        'data_jogo' => 'datetime',
        'status_jogo' => 'string',
        'resultado_real' => 'string',
    ];

    // Relacionamento com a rodada (muitos jogos pertencem a uma rodada)
    public function rodada()
    {
        return $this->belongsTo(Rodada::class, 'rodada_id');
    }

    // Relacionamento inverso (opcional) para pegar os jogadores ou resultados, se houver
    // public function jogadores() {
    //     return $this->hasMany(Jogador::class, 'jogo_id');
    // }
}
