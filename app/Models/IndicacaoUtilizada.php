<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class IndicacaoUtilizada extends Model
{
    protected $table = 'indicacoes_utilizadas';

    protected $fillable = [
        'indicador_id',
        'indicado_id',
        'status',
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
}
