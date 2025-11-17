<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Importa os middlewares
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware; // 👈 ADICIONE ESTA LINHA

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🔐 Middleware de rota (correto)
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'user'  => UserMiddleware::class, // 👈 ADICIONE AQUI
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
