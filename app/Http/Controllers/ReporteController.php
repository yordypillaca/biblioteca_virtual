<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $filtroFechas = '';
        $params = [];

        if ($desde && $hasta) {
            $filtroFechas = "WHERE p.fecha_prestamo BETWEEN TO_DATE(:desde, 'YYYY-MM-DD') AND TO_DATE(:hasta, 'YYYY-MM-DD')";
            $params = [
                'desde' => $desde,
                'hasta' => $hasta
            ];
        }


        $libros = DB::select("
            SELECT l.titulo, COUNT(*) as cantidad
            FROM prestamos p
            JOIN libros l ON p.id_libro = l.id_libro
            $filtroFechas
            GROUP BY l.titulo
            ORDER BY cantidad DESC
        ", $params);

        $usuarios = DB::select("
            SELECT u.nombre, COUNT(*) as prestamos
            FROM prestamos p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            $filtroFechas
            GROUP BY u.nombre
            ORDER BY prestamos DESC
        ", $params);

        return view('reportes.index', compact('libros', 'usuarios', 'desde', 'hasta'));
    }
}
