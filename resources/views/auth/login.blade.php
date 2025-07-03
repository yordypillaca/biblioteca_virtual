<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="login-card" style="max-width:400px; width:100%; margin:auto;">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Logo" class="login-logo">
        <h3 class="text-center mb-4"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</h3>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tipo de cuenta</label>
                <div class="d-flex gap-3 justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input radio-orange" type="radio" name="rol" id="rolUsuario"
                            value="usuario" required checked>
                        <label class="form-check-label" for="rolUsuario">
                            <i class="bi bi-person"></i> Usuario
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input radio-orange" type="radio" name="rol" id="rolBibliotecario"
                            value="bibliotecario" required>
                        <label class="form-check-label" for="rolBibliotecario">
                            <i class="bi bi-journal-bookmark"></i> Bibliotecario
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required
                    placeholder="Ingrese su correo electrónico">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required
                    placeholder="Ingrese su contraseña">
            </div>

            <div class="d-grid mb-3">
                <button class="btn btn-primary">Ingresar</button>
            </div>

            <div class="text-center">
                <a href="/register" class="text-decoration-none">¿No tienes cuenta? <b>Regístrate</b></a>
            </div>
        </form>
    </div>
</body>

</html>
