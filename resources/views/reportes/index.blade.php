<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reportes de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <x-header />

    <div class="main-content">
        <div class="row">

            <div class="col-lg-6 mb-4">
                <div class="register-card h-100 p-4 shadow">
                    <h3 class="mb-4"><i class="bi bi-bar-chart-line"></i> Reportes de Préstamos</h3>
                    <form method="GET" class="form-inline">
                        <label for="desde"><strong>Desde:</strong></label>
                        <input type="date" name="desde" class="form-control mb-2" value="{{ $desde }}">
                        <label for="hasta"><strong>Hasta:</strong></label>
                        <input type="date" name="hasta" class="form-control mb-2" value="{{ $hasta }}">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i>
                            Filtrar</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="register-card h-100 p-4 shadow">
                    <h3><i class="bi bi-book"></i> Libros más prestados</h3>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Cantidad de Préstamos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($libros as $libro)
                                <tr>
                                    <td>{{ $libro->titulo }}</td>
                                    <td>{{ $libro->cantidad }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">No hay resultados para mostrar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <h3><i class="bi bi-person"></i> Usuarios más activos</h3>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Préstamos Realizados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $u)
                                <tr>
                                    <td>{{ $u->nombre }}</td>
                                    <td>{{ $u->prestamos }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Sin registros disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
