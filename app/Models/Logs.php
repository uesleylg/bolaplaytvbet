<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'usuario',
        'acao',
        'tipo',
        'ip',
        'dispositivo'
    ];

    // Laravel já gerencia created_at e updated_at automaticamente
}
