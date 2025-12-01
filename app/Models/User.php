<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile; // importar o model Profile
use App\Models\Carteira; // importar o model Carteira

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'referencia_id',
        'profile_id',
        'status', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 Relacionamento com Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    // 🔹 Relacionamento com o usuário que indicou (referencia)
    public function referencia()
    {
        return $this->belongsTo(User::class, 'referencia_id');
    }

    // 🔹 Relacionamento com usuários indicados por este usuário
    public function indicados()
    {
        return $this->hasMany(User::class, 'referencia_id');
    }

    // 🔹 Relacionamento com a carteira do usuário
    public function carteira()
    {
        return $this->hasOne(Carteira::class, 'usuario_id');
    }
}
