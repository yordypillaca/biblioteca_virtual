<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <x-header />

    <div class="container main-content">
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="row align-items-start mb-5">
            @can('bibliotecario')
                <!-- FORMULARIO Y TABLA EDITABLE PARA BIBLIOTECARIO -->
                <div class="col-lg-4 mb-4">
                    <div class="register-card mx-auto mb-4" style="max-width:500px;">
                        <h3 class="mb-4 text-center"><i class="bi bi-journal-plus"></i> Agregar Nuevo Libro</h3>
                        <form action="/libros/crear" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-book"></i> Título del Libro</label>
                                <input type="text" class="form-control form-control-lg" name="titulo" required
                                    placeholder="Ingresa el título del libro">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-person"></i> Autor</label>
                                <input type="text" class="form-control form-control-lg" name="autor" required
                                    placeholder="Ingresa el autor del libro">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-tags"></i> Categoría</label>
                                <select name="id_categoria" class="form-select form-select-lg" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre_categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg">
                                    <i class="bi bi-plus-circle"></i> Guardar Libro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 mb-4">
                    <div class="card shadow table-container p-4" style="font-size: 1.5rem; max-width: 100%;">
                        <h3 class="mb-3"><i class="bi bi-list-ul"></i> Lista de Libros</h3>
                        <div class="table-responsive">
                            <!-- Tabla editable para bibliotecario -->
                            <table class="table table-bordered table-hover align-middle bg-white"
                                style="font-size: 1.25rem;">
                                <thead class="table-light">
                                    <tr style="height: 60px;">
                                        <th style="padding: 18px;">Título</th>
                                        <th style="padding: 18px;">Autor</th>
                                        <th style="padding: 18px;">Categoría</th>
                                        <th style="padding: 18px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr style="height: 60px;">
                                            <form action="/libros/actualizar/{{ $libro->id_libro }}" method="POST">
                                                @csrf
                                                <td><input type="text" name="titulo" value="{{ $libro->titulo }}"
                                                        class="form-control" style="font-size:1.1rem; height: 48px;">
                                                </td>
                                                <td><input type="text" name="autor" value="{{ $libro->autor }}"
                                                        class="form-control" style="font-size:1.1rem; height: 48px;">
                                                </td>
                                                <td>
                                                    <select name="id_categoria" class="form-select"
                                                        style="font-size:1.1rem; height: 48px;">
                                                        @foreach ($categorias as $cat)
                                                            <option value="{{ $cat->id_categoria }}"
                                                                {{ $libro->nombre_categoria == $cat->nombre_categoria ? 'selected' : '' }}>
                                                                {{ $cat->nombre_categoria }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-success btn-sm" title="Actualizar"><i
                                                                class="bi bi-arrow-repeat"></i></button>
                                                        <a href="/libros/eliminar/{{ $libro->id_libro }}"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('¿Eliminar este libro?')"
                                                            title="Eliminar">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <!-- TABLA SOLO LECTURA PARA USUARIO, OCUPANDO TODO EL ANCHO -->
                <div class="col-12 mb-4">
                    <div class="card shadow table-container p-4" style="font-size: 1.5rem; max-width: 100%;">
                        <h3 class="mb-3"><i class="bi bi-list-ul"></i> Lista de Libros</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle bg-white" style="font-size: 1.25rem;">
                                <thead class="table-light">
                                    <tr style="height: 60px;">
                                        <th style="padding: 18px;">Título</th>
                                        <th style="padding: 18px;">Autor</th>
                                        <th style="padding: 18px;">Categoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr style="height: 60px;">
                                            <td style="padding: 18px;">{{ $libro->titulo }}</td>
                                            <td style="padding: 18px;">{{ $libro->autor }}</td>
                                            <td style="padding: 18px;">{{ $libro->nombre_categoria }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</body>

</html>
