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
        'premio',
        'valor_bilhete',
        'premiacao_estimada',
        'descricao',
        'data_inicio',
        'data_fim',
        'status',
        'modo',
        'num_palpites',
        'multiplas',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'multiplas' => 'boolean',
    ];
}
