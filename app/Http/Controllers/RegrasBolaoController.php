<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegrasBolaoController extends Controller
{
    
      public function regras(Request $request)
    {


          return view('Paginas.User.Regras');
    }
}
