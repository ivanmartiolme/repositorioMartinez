<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartOrder - Bienvenido</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            padding: 100px 0;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .btn-custom {
            background-color: #ff7e5f;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #feb47b;
            color: white;
        }
    </style>
</head>
<body>
    <header class="py-3 bg-white shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">SmartOrder</h1>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-success">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <section class="hero text-center">
        <div class="container">
            <h1>Bienvenido a SmartOrder</h1>
            <p>La mejor solución para gestionar tus pedidos y mesas de manera eficiente.</p>
            <div class="mt-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom btn-lg me-2">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">¿Por qué elegir SmartOrder?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Gestión Eficiente</h5>
                            <p class="card-text">Administra tus pedidos y mesas de manera rápida y sencilla.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Interfaz Intuitiva</h5>
                            <p class="card-text">Diseño moderno y fácil de usar para todos los usuarios.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Soporte Técnico</h5>
                            <p class="card-text">Con cualquier duda que tengan consulte a los camareros.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 bg-dark text-white text-center">
        <p class="mb-0">© {{ date('Y') }} SmartOrder. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>