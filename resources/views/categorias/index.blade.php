<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Categorías</title>
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
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="register-card mx-auto mb-4" style="max-width:500px;">
                    <h3 class="mb-4 text-center"><i class="bi bi-tags"></i> Agregar Nueva Categoría</h3>
                    <form action="/categorias/crear" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-type"></i> Nombre de la categoría</label>
                            <input type="text" class="form-control form-control-lg" name="nombre_categoria" required
                                placeholder="Ingresa el nombre de la categoría">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg"><i class="bi bi-plus-circle"></i> Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="register-card mx-auto mb-4" style="max-width:500px;">
                    <h3 class="mb-3"><i class="bi bi-list-ul"></i> Lista de Categorías</h3>
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $cat)
                                <tr>
                                    <td>{{ $cat->nombre_categoria }}</td>
                                    <td>
                                        <a href="/categorias/eliminar/{{ $cat->id_categoria }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar esta categoría?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
