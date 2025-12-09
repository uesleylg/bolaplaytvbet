<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Saque extends Model
{
    use HasFactory;

    protected $table = 'saques';

    protected $fillable = [
        'user_id',
        'valor',
        'status',
        'chave_pix',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    protected $attributes = [
        'status' => 'Pendente',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
