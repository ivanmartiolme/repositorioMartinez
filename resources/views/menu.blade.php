<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Mensajes de error y éxito -->
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if(session('mensaje'))
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
            </div>
        @endif

        <!-- Título -->
        <h1 class="text-center mb-4">Menú</h1>

        <!-- Menú dividido en columnas -->
        <div class="row">
            @if($paginaActual == 1)
                <!-- Primera columna: Desayunos y Postres -->
                <div class="col-md-4">
                    <!-- Subcategoría: Desayunos -->
                    <h3 class="text-center mt-3">Desayunos</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['desayunos_postres'] as $item)
                                @if(in_array($item['nombre'], ['Café', 'Zumo de Naranja', 'Batido de Vainilla', 'Tostada con Mermelada', 'Tostada con Tomate y Aceite', 'Churros']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </form>

                    <!-- Subcategoría: Postres -->
                    <h3 class="text-center mt-3">Postres</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['desayunos_postres'] as $item)
                                @if(in_array($item['nombre'], ['Tarta de Chocolate', 'Tarta de Queso', 'Croissant', 'Bizcocho Casero']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </form>
                </div>

                <!-- Segunda columna: Bocadillos -->
                <div class="col-md-4">
                    <h3 class="text-center mt-3">Bocadillos</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['bocadillos'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                    <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>

                <!-- Tercera columna: Sándwiches -->
                <div class="col-md-4">
                    <h3 class="text-center mt-3">Sándwiches</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['sandwiches'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                    <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            @elseif($paginaActual == 2)
                <!-- Primera columna: Hamburguesas -->
                <div class="col-md-6">
                    <h3 class="text-center mt-3">Hamburguesas</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['hamburguesas'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                    <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>

                <!-- Segunda columna: Bebidas -->
                <div class="col-md-6">
                    <h3 class="text-center mt-3">Bebidas</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group">
                            @foreach($menuPaginado['bebidas'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                                    <button type="submit" name="pedido" value="{{ $item['id'] }}" class="btn btn-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            @endif
        </div>

        <!-- Navegación -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            @if($paginaActual > 1)
                <a href="{{ route('menu', ['page' => $paginaActual - 1]) }}" class="btn btn-outline-primary">← Anterior</a>
            @else
                <button class="btn btn-outline-secondary" disabled>← Anterior</button>
            @endif

            @if($paginaActual < $totalPaginas)
                <a href="{{ route('menu', ['page' => $paginaActual + 1]) }}" class="btn btn-outline-primary">Siguiente →</a>
            @else
                <button class="btn btn-outline-secondary" disabled>Siguiente →</button>
            @endif
        </div>

        <!-- Opciones -->
        <div class="text-center mt-4">
            <a href="{{ route('ver.pedido') }}" class="btn btn-success">Ver mi Pedido</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>