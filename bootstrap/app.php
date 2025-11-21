<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Models\Logs;


// Middlewares personalizados
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\ManutencaoMiddleware;

// Rate Limiter
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

// Valores do banco (em minutos)
$limiteTentativas = $configs['limite_login_tentativas'] ?? 5;
$tempoBloqueio   = $configs['limite_login_tempo_bloqueio'] ?? 1; // em minutos

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        // Aliases de middlewares
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'user'  => UserMiddleware::class,
        ]);

        // Middleware global para rotas Web
        $middleware->web([
            ManutencaoMiddleware::class,
        ]);
    })

 
->booting(function () use ($limiteTentativas, $tempoBloqueio) {

    // Limite de login
    RateLimiter::for('login', function ($request) use ($limiteTentativas, $tempoBloqueio) {
        return Limit::perMinutes($tempoBloqueio, $limiteTentativas)
            ->by($request->ip())
            ->response(function () use ($tempoBloqueio, $request) {

                // 📝 Log de tentativa de login bloqueada
                Logs::create([
                    'usuario' => $request->input('name') ?? 'desconhecido',
                    'acao' => "Muitas tentativas de login. Bloqueio por {$tempoBloqueio} minuto(s)",
                    'tipo' => 'Falha',
                    'ip' => $request->ip(),
                    'dispositivo' => $request->userAgent() ?? '-',
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Muitas tentativas! Aguarde {$tempoBloqueio} minuto(s) antes de tentar novamente."
                ], 429);
            });
    });

    // Limite de registro
    RateLimiter::for('register', function ($request) {
        $tentativas = 3;
        $tempo      = 1; // em minutos

        return Limit::perMinutes($tempo, $tentativas)
            ->by($request->ip())
            ->response(function () use ($tempo, $request) {

                // 📝 Log de tentativa de registro bloqueada
                Logs::create([
                    'usuario' => $request->input('name') ?? 'desconhecido',
                    'acao' => "Muitas tentativas de registro. Bloqueio por {$tempo} minuto(s)",
                    'tipo' => 'Falha',
                    'ip' => $request->ip(),
                    'dispositivo' => $request->userAgent() ?? '-',
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Você tentou criar muitas contas! Aguarde {$tempo} minuto(s) antes de tentar novamente."
                ], 429);
            });
    });

})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
