<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;

    protected $table = 'bilhete'; // Nome da tabela no banco

    protected $fillable = [
        'rodada_id',
        'usuario_id',
        'codigo_bilhete',
        'valor_aposta',
        'status',
        'premio_recebido'
    ];

    // Relacionamento com o usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relacionamento com os palpites
    public function palpites()
    {
        return $this->hasMany(Palpite::class, 'bilhete_id');
    }
}
