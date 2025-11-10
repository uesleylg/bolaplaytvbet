<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rodada;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        
        $agora = Carbon::now('America/Sao_Paulo'); // horário atual correto

        // Busca rodadas ativas e que ainda não terminaram
        $rodada = Rodada::where('status', 'Ativo')
            ->where('data_fim', '>', $agora)
            ->orderBy('data_fim', 'asc') // rodadas que vão acabar primeiro
            ->first();

        return view('Index', compact('rodada'));
    }
}
