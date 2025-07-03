<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = DB::select("SELECT * FROM categorias ORDER BY id_categoria");
        return view('categorias.index', compact('categorias'));
    }

    // Agregar nueva categoría (usando el paquete)
    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string'
        ]);

        DB::statement("BEGIN pkg_categorias.agregar_categoria(:nombre); END;", [
            'nombre' => $request->nombre_categoria
        ]);

        return redirect('/categorias')->with('success', 'Categoría agregada');
    }

    // Eliminar categoría (usando el paquete)
    public function destroy($id)
    {
        DB::statement("BEGIN pkg_categorias.eliminar_categoria(:id); END;", [
            'id' => $id
        ]);

        return redirect('/categorias')->with('success', 'Categoría eliminada');
    }
}
