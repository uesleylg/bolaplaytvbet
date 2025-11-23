<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;

Route::post('/gerar-pix', [PagamentoController::class, 'gerarPix']);
