<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\BilheteUsuarioController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UsuariosAdminController;
use App\Http\Controllers\Admin\RodadaController;
use App\Http\Controllers\Auth\AuthController; // ðŸ‘ˆ adicionado
use App\Http\Controllers\Admin\RodadaJogoController;
use App\Http\Controllers\PalpiteController;

use Illuminate\Cache\RateLimiting\Limit;

use App\Http\Controllers\JogosInfoController;
use App\Http\Controllers\CarrinhoPalpiteController;

use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\WebhookPixController;
use App\Http\Controllers\Admin\BilheteController;
use App\Http\Controllers\Admin\AfiliadoController;
use App\Http\Controllers\IndicacaoController;
use App\Http\Controllers\Admin\CarteiraController;
use App\Http\Controllers\Admin\MetaController;



Route::post('/gerar-pix', [PagamentoController::class, 'gerarPix'])->name('gerar.pix');
Route::post('/webhook/pix', [WebhookPixController::class, 'handle']);


// ðŸ  Rotas pÃºblicas
Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login')
    ->name('login.post');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:register')
    ->name('register.post');

Route::get('/rodadas/{id}/jogos', [RodadaController::class, 'jogos'])->name('rodadas.jogos');
Route::get('/ranking/{id?}', [RankingController::class, 'index'])->name('ranking.index');

// Definindo throttle para a rota pública
RateLimiter::for('jogos-publico', function ($request) {
    return Limit::perMinute(30)->by($request->ip()); // 30 requisições/minuto por IP
});

// Rota pública para pegar os jogos
Route::middleware('throttle:jogos-publico')
    ->get('/api/jogos/{rodada_id}', [RankingController::class, 'jogos_live'])
    ->name('ranking.index');



Route::middleware(['user'])->group(function () {
    Route::get('/indicacao', [IndicacaoController::class, 'index'])->name('indicacao.index');
    Route::get('/bilhete', [BilheteUsuarioController::class, 'index'])->name('bilhete.index');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::post('/palpites', [PalpiteController::class, 'store'])->name('palpites.store');
    
    Route::post('/carrinho/salvar', [CarrinhoPalpiteController::class, 'salvarCarrinho'])->name('carrinho.salvar');
    
    Route::put('/carrinho/{id}/atualizar', [CarrinhoPalpiteController::class, 'atualizarCarrinho'])->name('carrinho.atualizar');
    
    Route::delete('/carrinho/{id}/excluir', [CarrinhoPalpiteController::class, 'excluir']);
});



// ðŸ§© Rotas administrativas 
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['admin'])
    ->group(function () {

       

        Route::get('/', [HomeAdminController::class, 'index'])->name('index');
        Route::get('/usuarios', [UsuariosAdminController::class, 'index'])->name('usuarios.index');

        Route::get('/cadastro/bolao', [RodadaController::class, 'index'])->name('cadastro.rodada');
        Route::post('/rodadas/cadastro', [RodadaController::class, 'store'])->name('rodadas.store');
        Route::post('/rodadas/auditoria', [RodadaController::class, 'store_auditoria'])->name('rodadas.auditoria.store');

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
        Route::post('/config/excluir', [ConfiguracaoController::class, 'excluir'])->name('config.excluir');


        Route::get('/logs-sistema', [LogController::class, 'logs'])->name('index.logs');

        Route::resource('slides', SlideController::class)->except(['create', 'edit', 'show']);
        Route::delete('/slides/{slide}/delete-image', [SlideController::class, 'deleteImage'])
     ->name('slides.deleteImage');


      Route::get('/bilhetes', [BilheteController::class, 'index'])->name('index.bilhetes');
      Route::get('/dashboard-afiliados', [AfiliadoController::class, 'index'])->name('index.afiliados');
      Route::get('/metas', [MetaController::class, 'index'])->name('index.metas');
      Route::post('/metas/store', [MetaController::class, 'store'])->name('metas.store');
      Route::get('/metas/{id}', [MetaController::class, 'show'])->name('metas.show');
      Route::delete('/metas/{id}', [MetaController::class, 'destroy'])->name('metas.destroy');
      Route::put('/metas/update/{id}', [MetaController::class, 'update'])->name('metas.update');



      Route::get('/usuarios/{id}/carteira', [CarteiraController::class, 'index'])->name('index.carteira');
    });
