<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    // Nome da tabela (opcional se seguir padrão Laravel)
    protected $table = 'profiles';

    // Permite trabalhar com os campos timestamps
    public $timestamps = true;

    // Campos que podem ser preenchidos em mass assignment
    protected $fillable = [
        'name',
    ];

    // Relacionamento inverso com usuários
    public function users()
    {
        return $this->hasMany(User::class, 'profile_id');
    }
}
