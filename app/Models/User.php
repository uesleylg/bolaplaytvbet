<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile;
use App\Models\Carteira;
use App\Models\CarrinhoPalpite;
use App\Models\Bilhete;

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

    // 🔹 Perfil
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    // 🔹 Quem indicou o usuário
    public function referencia()
    {
        return $this->belongsTo(User::class, 'referencia_id');
    }

    // 🔹 Usuários que ele indicou
    public function indicados()
    {
        return $this->hasMany(User::class, 'referencia_id');
    }
    public function indicacoes()
{
    return $this->hasMany(\App\Models\Indicacao::class, 'indicador_id');
}


    // 🔹 Carteira do usuário
    public function carteira()
    {
        return $this->hasOne(Carteira::class, 'usuario_id');
    }

    // 🔹 Carrinhos do usuário
    public function carrinhos()
    {
        return $this->hasMany(CarrinhoPalpite::class, 'usuario_id');
    }

    // 🔹 Bilhetes do usuário (HasManyThrough)
  public function bilhetes()
{
    return $this->hasManyThrough(
        Bilhete::class,
        CarrinhoPalpite::class,
        'usuario_id',   // chave em carrinho_palpites que aponta para users
        'carrinho_id',  // chave em bilhetes que aponta para carrinho
        'id',           // id em users
        'id'            // id em carrinho_palpites
    )->whereHas('carrinho', function ($q) {
        $q->where('status', 'pago');
    });
}

}
