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
        'data_inicio',
        'data_fim',
        'status',
    ];

    // Relacionamento: uma rodada tem vários jogos
    public function jogos()
    {
        return $this->hasMany(Jogo::class, 'rodada_id');
    }

    // Relacionamento: uma rodada pode ter várias apostas
    public function apostas()
    {
        return $this->hasMany(Aposta::class, 'rodada_id');
    }
}
