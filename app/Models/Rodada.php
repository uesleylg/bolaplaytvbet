<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{
    use HasFactory;

    protected $table = 'rodadas';

    protected $fillable = [
        'nome',
        'valor_bilhete',
        'premiacao_estimada',
        'descricao',
        'data_inicio',
        'data_fim',
        'modo',
        'num_palpites',
        'multiplas',
        'status',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'multiplas' => 'boolean',
    ];

    /**
     * Relação com os jogos da rodada.
     */
    public function jogos()
    {
        return $this->hasMany(RodadaJogo::class, 'rodada_id', 'id');
    }
}
