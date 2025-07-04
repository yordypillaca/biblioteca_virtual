<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <div class="header-bar">
        <div>
            <strong><i class="bi bi-person-circle"></i> {{ Auth::user()->nombre }}</strong>
        </div>
        <div class="nav-buttons">
            @if (Auth::user()->rol === 'bibliotecario')
                <a href="/categorias" class="btn btn-orange-header btn-sm"><i class="bi bi-tags"></i> Categorías</a>
            @endif
            <a href="/libros" class="btn btn-orange-header btn-sm"><i class="bi bi-book"></i> Libro Nuevo</a>
            <a href="/prestamos" class="btn btn-orange-header btn-sm"><i class="bi bi-journal-check"></i> Préstamos</a>
            @if (Auth::user()->rol === 'bibliotecario')
                <a href="/reportes" class="btn btn-orange-header btn-sm"><i class="bi bi-bar-chart-line"></i>
                    Reportes</a>
                <a href="/usuarios" class="btn btn-orange-header btn-sm"><i class="bi bi-people"></i> Usuarios</a>
            @endif
        </div>

        <form action="/logout" method="POST" class="m-0">
            @csrf
            <button class="btn btn-danger btn-sm logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</button>
        </form>
    </div>

    <script>
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-buttons a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>

    <div class="main-content">
        <div class="welcome-title">Bienvenido a la Biblioteca Virtual</div>
        <div class="subtitle">Explora, aprende y descubre nuevas historias y conocimientos.</div>

        @if (Auth::user()->rol === 'bibliotecario')
            <div class="alert alert-info text-center mb-4">
                <i class="bi bi-person-badge"></i> Estás en modo <b>Bibliotecario</b>. Tienes acceso a la gestión de
                libros, usuarios, categorías, préstamos y reportes.
            </div>
            <div class="row g-4 justify-content-center align-items-stretch">
                <div class="col-md-4">
                    <a href="/categorias" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-tags display-4 text-secondary"></i>
                                <h5 class="mt-3">Categorías</h5>
                                <p class="text-muted">Gestiona las categorías de libros.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/libros" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-book display-4 text-primary"></i>
                                <h5 class="mt-3">Gestión de Libros</h5>
                                <p class="text-muted">Agrega, edita o elimina libros.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/prestamos" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-journal-check display-4 text-success"></i>
                                <h5 class="mt-3">Préstamos</h5>
                                <p class="text-muted">Registra y gestiona préstamos.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/reportes" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-bar-chart-line display-4 text-info"></i>
                                <h5 class="mt-3">Reportes</h5>
                                <p class="text-muted">Consulta reportes de la biblioteca.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/usuarios" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-people display-4 text-warning"></i>
                                <h5 class="mt-3">Gestión de Usuarios</h5>
                                <p class="text-muted">Administra usuarios y roles.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @else
            <div class="alert alert-primary text-center mb-4">
                <i class="bi bi-person"></i> Estás en modo <b>Usuario</b>. Puedes consultar libros y tus préstamos.
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <a href="/libros" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-book display-4 text-primary"></i>
                                <h5 class="mt-3">Catálogo de Libros</h5>
                                <p class="text-muted">Explora y consulta los libros disponibles.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/prestamos" class="text-decoration-none">
                        <div class="card h-100 text-center shadow">
                            <div class="card-body">
                                <i class="bi bi-journal-check display-4 text-success"></i>
                                <h5 class="mt-3">Mis Préstamos</h5>
                                <p class="text-muted">Consulta el historial de tus préstamos.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script>
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-buttons a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.remove('btn-outline-primary', 'btn-outline-success', 'btn-outline-warning',
                    'btn-outline-secondary', 'btn-outline-info');
                link.classList.add('btn-dark');
            }
        });
    </script>

</body>

</html>
