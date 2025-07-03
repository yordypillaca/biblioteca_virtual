<div class="header-bar">
    <div>
        <strong><i class="bi bi-person-circle"></i> {{ Auth::user()->nombre }}</strong>
    </div>
    <div class="nav-buttons">
        <a href="/home" class="btn btn-orange-header btn-sm"><i class="bi bi-house-door"></i> Inicio</a>
        @if (Auth::user()->rol === 'bibliotecario')
            <a href="/categorias" class="btn btn-orange-header btn-sm"><i class="bi bi-tags"></i> Categorías</a>
        @endif
        <a href="/libros" class="btn btn-orange-header btn-sm"><i class="bi bi-book"></i> Libro Nuevo</a>
        <a href="/prestamos" class="btn btn-orange-header btn-sm"><i class="bi bi-journal-check"></i> Préstamos</a>
        @if (Auth::user()->rol === 'bibliotecario')
            <a href="/reportes" class="btn btn-orange-header btn-sm"><i class="bi bi-bar-chart-line"></i> Reportes</a>
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
