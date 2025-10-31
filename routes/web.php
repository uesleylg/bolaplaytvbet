<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\BilheteUsuarioController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UsuariosAdminController;

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

// 🔐 Rotas administrativas
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeAdminController::class, 'index'])->name('index');
    Route::get('/usuarios', [UsuariosAdminController::class, 'index'])->name('usuarios.index');
});
