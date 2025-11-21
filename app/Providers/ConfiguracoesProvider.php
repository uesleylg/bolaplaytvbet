<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Configuracao;

class ConfiguracoesProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Carrega direto do banco em toda request
        $configs = Configuracao::pluck('valor', 'chave')->toArray();

        // Disponível em todas as views
        view()->share('configs', $configs);
    }
}
