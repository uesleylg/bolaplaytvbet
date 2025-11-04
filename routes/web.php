<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\BilheteUsuarioController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UsuariosAdminController;
use App\Http\Controllers\Admin\RodadaController;
use App\Http\Controllers\Auth\AuthController; // 👈 adicionado

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui é onde você registra as rotas web para sua aplicação.
| Essas rotas são carregadas pelo RouteServiceProvider e
| todas elas serão atribuídas ao grupo de middleware "web".
|--------------------------------------------------------------------------
*/

// 🏠 Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/bilhete', [BilheteUsuarioController::class, 'index'])->name('bilhete.index');

// 🔐 Autenticação (simples com HTML/CSS base)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 🧩 Rotas administrativas (proteção opcional)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [HomeAdminController::class, 'index'])->name('index');
        Route::get('/usuarios', [UsuariosAdminController::class, 'index'])->name('usuarios.index');
        Route::get('/cadastro/bolao', [RodadaController::class, 'create'])->name('cadastro.rodada');
    });
