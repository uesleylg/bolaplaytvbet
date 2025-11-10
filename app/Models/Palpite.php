<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Palpite extends Model
{
    protected $fillable = [
        'rodada_id',
        'usuario_id',
        'codigo_bilhete',
        'valor_aposta',
        'status',
        'premio_recebido'
    ];

    public function jogos()
    {
        return $this->hasMany(PalpiteJogo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function rodada()
    {
        return $this->belongsTo(Rodada::class, 'rodada_id');
    }
}
