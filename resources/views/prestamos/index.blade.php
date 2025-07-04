<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <x-header />

    <div class="main-content">

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="register-card mx-auto mb-4" style="max-width:600px;">
                    <h3 class="mb-4 text-center"><i class="bi bi-arrow-left-right"></i> Registrar nuevo préstamo
                    </h3>
                    <form action="/prestamos/crear" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">📚 Libro disponible:</label>
                            <select name="id_libro" class="form-select" required>
                                <option value="">Seleccione libro</option>
                                @foreach ($libros_disponibles as $libro)
                                    <option value="{{ $libro->id_libro }}">{{ $libro->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        @can('bibliotecario')
                            <div class="col-md-6">
                                <label class="form-label">👤 Usuario:</label>
                                <select name="id_usuario" class="form-select" required>
                                    <option value="">Seleccione usuario</option>
                                    @foreach ($usuarios as $u)
                                        <option value="{{ $u->id_usuario }}">{{ $u->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="id_usuario" value="{{ Auth::user()->id_usuario }}">
                        @endcan
                        <div class="col-md-6">
                            <label class="form-label">📅 Fecha de préstamo:</label>
                            <input type="date" name="fecha_prestamo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">📅 Fecha de devolución:</label>
                            <input type="date" name="fecha_devolucion" class="form-control" required>
                        </div>
                        <div class="col-12 d-grid mt-3">
                            <button class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle"></i> Registrar Préstamo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <div class="card shadow table-container p-4 h-100">
                    <h3 class="mb-3"><i class="bi bi-clock-history"></i> Historial de Préstamos</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Libro</th>
                                    @can('bibliotecario')
                                        <th>Usuario</th>
                                    @endcan
                                    <th>Fecha Préstamo</th>
                                    <th>Fecha Devolución</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $p)
                                    @if (Auth::user()->rol === 'bibliotecario' || $p->id_usuario == Auth::user()->id_usuario)
                                        <tr>
                                            <td>{{ $p->titulo }}</td>
                                            @can('bibliotecario')
                                                <td>{{ $p->nombre_usuario }}</td>
                                            @endcan
                                            <td>{{ $p->fecha_prestamo ? \Carbon\Carbon::parse($p->fecha_prestamo)->format('d/m/Y') : '' }}
                                            </td>
                                            <td>{{ $p->fecha_devolucion ? \Carbon\Carbon::parse($p->fecha_devolucion)->format('d/m/Y') : '---' }}
                                            </td>
                                            <td>
                                                @if ($p->devuelto == 'N')
                                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                                @else
                                                    <span class="badge bg-success">Devuelto</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($p->devuelto == 'N')
                                                    <a href="/prestamos/devolver/{{ $p->id_prestamo }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="bi bi-arrow-return-left"></i> Devolver
                                                    </a>
                                                @else
                                                    <span class="text-muted">✔</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
