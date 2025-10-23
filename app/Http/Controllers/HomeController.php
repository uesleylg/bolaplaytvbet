<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        // Aqui você pode buscar dados do ranking ou retornar uma view
        return view('Index'); // retorna a view resources/views/ranking/index.blade.php
    }
}
