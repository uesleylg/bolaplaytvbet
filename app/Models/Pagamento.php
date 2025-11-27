<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    // Se o nome da tabela não seguir plural padrão (pagamentos), define manualmente
    protected $table = 'pagamentos';

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'usuario_id',
        'payment_id',
        'status',
        'valor',
        'pix_qr_base64',
        'pix_copia_cola',
        'carrinho_ids',
    ];

    // Tipo de campo
    protected $casts = [
        'carrinho_ids' => 'array', // JSON para array automaticamente
        'valor' => 'decimal:2',    // Garante decimal
    ];

    /**
     * Relacionamento com o usuário
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
