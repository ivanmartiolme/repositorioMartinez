@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Mensajes de error y éxito -->
    @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if(session('mensaje'))
        <div class="alert alert-success text-center shadow-sm" role="alert">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- Botón para seleccionar mesa -->
    <div class="text-center mb-5">
        <a href="{{ route('mostrar.mesas') }}" class="btn btn-outline-primary btn-lg shadow-sm">
            🪑 Seleccionar Mesa
        </a>
    </div>

    <!-- Menú dividido en columnas -->
    <div class="row g-4">
        @if($paginaActual == 1)
            <!-- Primera columna: Desayunos y Postres -->
            <div class="col-md-4">
                <div class="menu-category shadow-lg p-3 rounded">
                    <h3 class="text-center text-primary fw-bold">☕ Desayunos</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['desayunos_postres']->where('categoria', 'desayunos') as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>

                <div class="menu-category shadow-lg p-3 rounded mt-4">
                    <h3 class="text-center text-primary fw-bold">🍰 Postres</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['desayunos_postres']->where('categoria', 'postres') as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Segunda columna: Bocadillos -->
            <div class="col-md-4">
                <div class="menu-category shadow-lg p-3 rounded">
                    <h3 class="text-center text-primary fw-bold">🥪 Bocadillos</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['bocadillos'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Tercera columna: Sándwiches -->
            <div class="col-md-4">
                <div class="menu-category shadow-lg p-3 rounded">
                    <h3 class="text-center text-primary fw-bold">🥪 Sándwiches</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['sandwiches'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        @elseif($paginaActual == 2)
            <!-- Primera columna: Hamburguesas -->
            <div class="col-md-6">
                <div class="menu-category shadow-lg p-3 rounded">
                    <h3 class="text-center text-primary fw-bold">🍔 Hamburguesas</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['hamburguesas'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Segunda columna: Bebidas -->
            <div class="col-md-6">
                <div class="menu-category shadow-lg p-3 rounded">
                    <h3 class="text-center text-primary fw-bold">🥤 Bebidas</h3>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="list-group list-group-flush">
                            @foreach($menuPaginado['bebidas'] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nombre }} - <strong>{{ number_format($item->precio, 2) }}€</strong></span>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="btn btn-outline-primary btn-sm">Agregar</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <!-- Navegación -->
    <div class="navigation-buttons d-flex justify-content-between align-items-center mt-5">
        @if($paginaActual > 1)
            <a href="{{ route('menu', ['page' => $paginaActual - 1]) }}" class="btn btn-outline-primary btn-lg">← Anterior</a>
        @else
            <button class="btn btn-outline-secondary btn-lg" disabled>← Anterior</button>
        @endif

        @if($paginaActual < $totalPaginas)
            <a href="{{ route('menu', ['page' => $paginaActual + 1]) }}" class="btn btn-outline-primary btn-lg">Siguiente →</a>
        @else
            <button class="btn btn-outline-secondary btn-lg" disabled>Siguiente →</button>
        @endif
    </div>

    <!-- Opciones -->
    <div class="text-center view-order-btn mt-5">
        <a href="{{ route('ver.pedido') }}" class="btn btn-success btn-lg shadow-lg">🛒 Ver mi Pedido</a>
    </div>
</div>
@endsection