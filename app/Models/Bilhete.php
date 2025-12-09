<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    protected $table = 'bilhetes';

    protected $fillable = [
        'carrinho_id',
        'codigo_bilhete',
        'premio_recebido',
        'status'
    ];

    public function carrinho()
    {
        return $this->belongsTo(CarrinhoPalpite::class, 'carrinho_id');
    }


}
