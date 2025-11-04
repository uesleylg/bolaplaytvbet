<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeAdminController extends Controller
{
    public function index()
    {
        
        return view('Admin.index'); // ou a view que você quiser exibir
    }
}
