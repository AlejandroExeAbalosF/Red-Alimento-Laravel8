<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('panel.admin.lista_usuarios.index');
    }

    public function get_users() {
        
        // Todos los usuarios cargados en la BD
        
        //$users = User::all();
         // Info de usuarios que tengan asignado algunos de los roles pasados por el array
        $users = User::role(['vendedor', 'cliente'])->get(); 
        // Info de usuarios acompañados con la info de su rol
        //$users = User::with('roles')->get();
        return response()->json($users);

    }
}
