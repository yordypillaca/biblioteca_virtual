<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    public function index()
    {
        $libros = DB::select("
            SELECT l.id_libro, l.titulo, l.autor, c.nombre_categoria
            FROM libros l
            JOIN categorias c ON l.id_categoria = c.id_categoria
            ORDER BY l.id_libro
        ");

        $categorias = DB::select("SELECT * FROM categorias");

        return view('libros.index', compact('libros', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'id_categoria' => 'required|numeric'
        ]);

        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $id_categoria = $request->input('id_categoria');

        DB::statement("BEGIN agregar_libro(:titulo, :autor, :id_categoria); END;", [
            'titulo' => $titulo,
            'autor' => $autor,
            'id_categoria' => $id_categoria
        ]);

        return redirect()->route('libros.index')->with('success', 'Libro agregado correctamente');
    }

    public function update(Request $request, $id)
    {
        $titulo = $request->input('titulo');
        $autor = $request->input('autor');
        $id_categoria = $request->input('id_categoria');

        DB::statement("BEGIN actualizar_libro(:id_libro, :titulo, :autor, :id_categoria); END;",
            [
                'id_libro' => $id,
                'titulo' => $titulo,
                'autor' => $autor,
                'id_categoria' => $id_categoria
            ]
        );

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente');
    }

    public function destroy($id)
    {
        DB::statement("BEGIN eliminar_libro(:id_libro); END;", ['id_libro' => $id]);

        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente');
    }
}
