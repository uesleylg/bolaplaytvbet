<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rodada;
use Carbon\Carbon;
use App\Models\CarrinhoPalpite;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
{
    $agora = Carbon::now('America/Sao_Paulo');

    $rodada = Rodada::where('status', 'Ativo')
        ->where('data_fim', '>', $agora)
        ->orderBy('data_fim', 'asc')
        ->first();

    return view('Index', compact('rodada'));
}

}
