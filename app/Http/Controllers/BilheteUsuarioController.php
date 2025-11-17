<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoPalpite;
use Illuminate\Support\Facades\Auth;

class BilheteUsuarioController extends Controller
{
    public function index()
    {
        // Busca todos os bilhetes do usuário autenticado
        $usuarioId = Auth::id();

        $bilhetes = CarrinhoPalpite::where('usuario_id', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Paginas.User.BilheteUsuario', compact('bilhetes'));
    }
}
