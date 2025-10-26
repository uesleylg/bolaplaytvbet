<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BilheteUsuarioController extends Controller
{
        public function index()
    {
        // Aqui você pode buscar dados do ranking ou retornar uma view
        return view('BilheteUsuario'); // retorna a view resources/views/ranking/index.blade.php
    }
}
