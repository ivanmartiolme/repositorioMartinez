<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .menu-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .menu-category {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .menu-category h3 {
            color: #007bff;
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .navigation-buttons {
            margin-top: 30px;
        }
        .navigation-buttons .btn {
            width: 150px;
        }
        .view-order-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
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
        <div class="menu-header text-center">
            <h1>Menú del Restaurante</h1>
            <p>Selecciona los productos que deseas agregar a tu pedido</p>
        </div>

        <!-- Menú dividido en columnas -->
        <div class="row">
            @if($paginaActual == 1)
                <!-- Primera columna: Desayunos y Postres -->
                <div class="col-md-4">
                    <div class="menu-category">
                        <h3 class="text-center">Desayunos</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['desayunos_postres']->where('categoria', 'desayunos') as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>

                    <div class="menu-category">
                        <h3 class="text-center">Postres</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['desayunos_postres']->where('categoria', 'postres') as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>

                <!-- Segunda columna: Bocadillos -->
                <div class="col-md-4">
                    <div class="menu-category">
                        <h3 class="text-center">Bocadillos</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['bocadillos'] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>

                <!-- Tercera columna: Sándwiches -->
                <div class="col-md-4">
                    <div class="menu-category">
                        <h3 class="text-center">Sándwiches</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['sandwiches'] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            @elseif($paginaActual == 2)
                <!-- Primera columna: Hamburguesas -->
                <div class="col-md-6">
                    <div class="menu-category">
                        <h3 class="text-center">Hamburguesas</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['hamburguesas'] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>

                <!-- Segunda columna: Bebidas -->
                <div class="col-md-6">
                    <div class="menu-category">
                        <h3 class="text-center">Bebidas</h3>
                        <form action="{{ route('agregar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mesa_id" value="1">
                            <ul class="list-group">
                                @foreach($menuPaginado['bebidas'] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->nombre }} - {{ number_format($item->precio, 2) }}€</span>
                                        <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-primary btn-sm">Agregar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Navegación -->
        <div class="navigation-buttons d-flex justify-content-between align-items-center">
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
        <div class="text-center view-order-btn">
            <a href="{{ route('ver.pedido') }}" class="btn btn-success">Ver mi Pedido</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>