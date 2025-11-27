<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
{
     public function index()
    {
        return view('Paginas.User.indicacao');
    }
}
