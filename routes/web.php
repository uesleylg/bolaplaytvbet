<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BilheteUsuarioController;

Route::get('/', function () {
    return view('Index');
});



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/bilhete', [BilheteUsuarioController::class, 'index'])->name('bilhete.index');
