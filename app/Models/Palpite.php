<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palpite extends Model
{
    use HasFactory;

    protected $table = 'palpite'; // Nome da tabela no banco

    protected $fillable = [
        'bilhete_id',
        'rodada_jogo_id',
        'escolha',
        'resultado_correto'
    ];

    // Relacionamento com o bilhete
    public function bilhete()
    {
        return $this->belongsTo(Bilhete::class, 'bilhete_id');
    }

    // Relacionamento com o jogo da rodada
    public function rodadaJogo()
    {
        return $this->belongsTo(RodadaJogo::class, 'rodada_jogo_id');
    }
}
