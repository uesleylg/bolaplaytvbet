<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarrinhoPalpite extends Model
{
    protected $table = 'carrinho_palpites';

    protected $fillable = [
        'usuario_id',
        'rodada_id',
        'quantidade_bilhetes',
        'valor_total',
        'combinacoes_compactadas',
        'status',
    ];

    // Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function rodada()
    {
        return $this->belongsTo(Rodada::class, 'rodada_id');
    }

    // Compactar combinações
    public static function compactarCombinacoes(array $combinacoes)
    {
        return base64_encode(gzcompress(json_encode($combinacoes)));
    }

    // Descompactar combinações
  //  public static function descompactarCombinacoes(string $compactado)
  //  {
  //      return json_decode(gzuncompress(base64_decode($compactado)), true);
  //  }

public static function descompactarCombinacoes(string $valor)
{
    $decoded = base64_decode($valor, true);

    if ($decoded === false) {
        return [$valor];
    }

    $uncompressed = @gzuncompress($decoded);

    if ($uncompressed === false) {
        return [$valor];
    }

    return json_decode($uncompressed, true);
}

    
}
