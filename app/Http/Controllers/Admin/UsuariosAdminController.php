<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosAdminController extends Controller
{
    public function index()
    {

         $users = User::with(['profile', 'referencia'])->orderBy('id', 'desc')->get();
         $totalUsuarios = User::count();

        $totalUsuarios = User::count();
        $totalAtivos = User::where('status', 'Ativo')->count();
        $totalBloqueados = User::where('status', 'Bloqueado')->count();

    return view('Admin.usuarios', compact(
        'users',
        'totalUsuarios',
        'totalAtivos',
        'totalBloqueados'
    ));
   
    }
}
