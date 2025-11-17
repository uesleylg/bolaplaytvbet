<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\BilheteUsuarioController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UsuariosAdminController;
use App\Http\Controllers\Admin\RodadaController;
use App\Http\Controllers\Auth\AuthController; // 👈 adicionado
use App\Http\Controllers\Admin\RodadaJogoController;
use App\Http\Controllers\PalpiteController;

use App\Http\Controllers\JogosinfoController;
use App\Http\Controllers\CarrinhoPalpiteController;

use App\Http\Controllers\ConfiguracaoController;


use Illuminate\Support\Facades\Http;


Route::get('/api/jogos-uol', function () {
    $url = "https://www.uol.com.br/esporte/service/?loadComponent=api&data=%7B%22module%22%3A%22tools%22%2C%22api%22%3A%22json%22%2C%22method%22%3A%22open%22%2C%22busca%22%3A%22commons.uol.com.br%2Fsistemas%2Fesporte%2Fmodalidades%2Ffutebol%2Fcampeonatos%2Fetc%2Fjogos%2Fresultados_e_proximos%2Fdados.json%22%7D";
    
    $response = Http::get($url);
    return $response->json();
})->name('api.jogos-uol');
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
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/rodadas/{id}/jogos', [RodadaController::class, 'jogos'])->name('rodadas.jogos');
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');



Route::middleware(['user'])->group(function () {

    Route::get('/bilhete', [BilheteUsuarioController::class, 'index'])->name('bilhete.index');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::post('/palpites', [PalpiteController::class, 'store'])->name('palpites.store');
    
    Route::post('/carrinho/salvar', [CarrinhoPalpiteController::class, 'salvarCarrinho'])->name('carrinho.salvar');
    
    Route::put('/carrinho/{id}/atualizar', [CarrinhoPalpiteController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');
    
    Route::delete('/carrinho/{id}/excluir', [CarrinhoPalpiteController::class, 'excluir']);
});



// 🧩 Rotas administrativas 
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', [HomeAdminController::class, 'index'])->name('index');
        Route::get('/usuarios', [UsuariosAdminController::class, 'index'])->name('usuarios.index');

        Route::get('/cadastro/bolao', [RodadaController::class, 'index'])->name('cadastro.rodada');
        Route::post('/rodadas/cadastro', [RodadaController::class, 'store'])->name('rodadas.store');
        Route::put('/rodadas/{id}', [RodadaController::class, 'update'])->name('rodadas.update');
        Route::delete('/rodadas/{id}', [RodadaController::class, 'destroy'])->name('rodadas.destroy');

        Route::get('/get/jogos', [JogosinfoController::class, 'jogos'])->name('get.jogos');
        Route::get('get/odds/{id}', [JogosInfoController::class, 'odds'])->name('get.odds');
        Route::get('get/placar/{id}', [JogosInfoController::class, 'placar'])->name('get.placar');
        Route::post('rodadas/jogos', [RodadaJogoController::class, 'store'])->name('rodadas.jogos.store');

        Route::delete('/rodadas/{rodada}/jogos/excluir', [RodadaController::class, 'excluirJogos'])->name('rodadas.excluirJogos');

        Route::get('/carrinho', [CarrinhoPalpiteController::class, 'carrinho'])->name('get.carrinho');
        Route::delete('/carrinho/{id}', [CarrinhoPalpiteController::class, 'destroy'])->name('carrinho.destroy');
        Route::put('/carrinhos/{id}', [CarrinhoPalpiteController::class, 'update'])->name('carrinhos.update');

        Route::post('/register', [AuthController::class, 'adminregister'])->name('register.post');
        Route::put('/usuario/{id}', [AuthController::class, 'update'])->name('usuario.update');
        Route::delete('/usuario/{id}', [AuthController::class, 'destroy'])->name('usuario.destroy');


        Route::get('/configuracao', [ConfiguracaoController::class, 'index'])->name('index.conf');
        Route::post('/configuracoes/salvar', [ConfiguracaoController::class, 'salvar'])->name('config.salvar');
    });
