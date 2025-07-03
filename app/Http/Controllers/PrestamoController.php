<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = DB::select("
            SELECT p.id_prestamo, p.id_libro, p.id_usuario,
                   p.fecha_prestamo, p.fecha_devolucion, p.devuelto,
                   l.titulo, u.nombre AS nombre_usuario
            FROM prestamos p
            JOIN libros l ON p.id_libro = l.id_libro
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            ORDER BY p.fecha_prestamo DESC
        ");

        $libros_disponibles = DB::select("SELECT id_libro, titulo FROM libros WHERE disponible = 'S'");
        $usuarios = DB::select("SELECT id_usuario, nombre FROM usuarios");

        return view('prestamos.index', compact('prestamos', 'libros_disponibles', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_libro' => 'required|numeric',
            'id_usuario' => 'required|numeric',
            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
        ]);

        $fechaPrestamo = $request->input('fecha_prestamo')
            ? \Carbon\Carbon::parse($request->input('fecha_prestamo'))->format('Y-m-d H:i:s')
            : null;
        $fechaDevolucion = $request->input('fecha_devolucion')
            ? \Carbon\Carbon::parse($request->input('fecha_devolucion'))->format('Y-m-d H:i:s')
            : null;

        DB::statement("BEGIN registrar_prestamo(:id_usuario, :id_libro, :fecha_prestamo, :fecha_devolucion); END;", [
            'id_usuario' => $request->id_usuario,
            'id_libro' => $request->id_libro,
            'fecha_prestamo' => $fechaPrestamo,
            'fecha_devolucion' => $fechaDevolucion
        ]);

        return redirect('/prestamos')->with('success', 'Préstamo registrado con éxito');
    }

    public function devolver($id)
    {
        DB::statement("BEGIN devolver_libro(:id); END;", ['id' => $id]);
        return redirect('/prestamos')->with('success', 'Libro devuelto');
    }
}
