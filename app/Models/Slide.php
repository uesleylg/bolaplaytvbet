<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'imagem_desktop',
        'imagem_mobile',
        'ordem',
        'ativo'
    ];
}
