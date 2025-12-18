<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $table = 'metas';

 protected $fillable = [
    'nivel',
    'titulo',
    'descricao',
    'quantidade_indicados',
    'modo',
    'bonus_valor',
    'status',
];


    protected $casts = [
        'bonus_valor' => 'decimal:2',
        'quantidade_indicados' => 'integer',
        'nivel' => 'integer',
    ];
}
