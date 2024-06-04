<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    //
    public function index()
    {
        //
        $usuarios = Usuarios::all();
        return view('panel.usuarios.index', compact('usuarios'));
    }
}
