<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bilhete;

class Indicacao extends Model
{
    // 🔹 Nome da tabela
    protected $table = 'indicacoes';

    // 🔹 Colunas preenchíveis
    protected $fillable = [
        'indicador_id',
        'indicado_id',
        'bilhete_id',
        'status',
        'resgatado',
    ];

    public $timestamps = true;

    // 🔹 Relacionamento com quem indicou
    public function indicador()
    {
        return $this->belongsTo(User::class, 'indicador_id');
    }

    // 🔹 Relacionamento com o indicado
    public function indicado()
    {
        return $this->belongsTo(User::class, 'indicado_id');
    }

    // 🔹 Relacionamento com o bilhete (pode ser NULL se ainda não comprou)
    public function bilhete()
    {
        return $this->belongsTo(Bilhete::class, 'bilhete_id');
    }
}
