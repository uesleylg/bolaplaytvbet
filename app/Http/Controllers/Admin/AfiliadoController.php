<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AfiliadoController extends Controller
{
      public function index(Request $request)
    {


          return view('Paginas.Admin.DashboardAfiliado');
    }
     public function metas(Request $request)
    {


          return view('Paginas.Admin.metas');
    }
}
