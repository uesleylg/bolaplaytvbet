<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';

    protected $fillable = [
        'chave',
        'valor',
    ];

    public $timestamps = true;

    // Helper: pega valor pela chave
    public static function get($key, $default = null)
    {
        $config = self::where('chave', $key)->first();
        return $config ? $config->valor : $default;
    }

    // Helper: salva valor pela chave
    public static function set($key, $value)
    {
        return self::updateOrCreate(
            ['chave' => $key],
            ['valor' => $value]
        );
    }
}
