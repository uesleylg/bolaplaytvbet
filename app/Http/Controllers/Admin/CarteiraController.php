<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarteiraController extends Controller
{
      public function index(Request $request)
    {


          return view('Paginas.Admin.carteira');
    }
}
