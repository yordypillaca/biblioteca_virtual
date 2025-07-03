<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::select("SELECT * FROM usuarios ORDER BY id_usuario DESC");
        return view('usuarios.index', compact('usuarios'));
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM usuarios WHERE id_usuario = :id", ['id' => $id]);
        return redirect('/usuarios')->with('success', 'Usuario eliminado correctamente');
    }
}
