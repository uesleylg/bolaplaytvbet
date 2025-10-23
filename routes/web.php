<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('Index');
});



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
