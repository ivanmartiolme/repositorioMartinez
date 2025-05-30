<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pedido</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CDN (para clases tailwind) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>

    @php
        $mesa_id = session('mesa_id');
        $productosSession = session("pedido_$mesa_id", []);
    @endphp

    <div class="container py-5">

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

        <!-- Cabecera personalizada -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-500 rounded-xl shadow-xl p-6 mb-8">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="text-white">
                    <h1 class="fs-2 fw-bold">Mi Pedido</h1>
                    <p class="mb-0">Revisa tus productos y confirma tu pedido</p>
                </div>
                <a href="{{ route('menu') }}" id="btnVolverMenu" class="btn btn-light mt-3 mt-md-0">
                    Volver al Menú
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Lista de productos -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        Productos seleccionados
                    </div>
                    <ul class="list-group list-group-flush" id="listaProductos">
                        @forelse($productosSession as $index => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item['nombre'] }}</strong>
                                    <span class="text-muted ms-2">{{ number_format($item['precio'], 2) }}€</span>
                                </div>
                                <form action="{{ route('eliminar.pedido') }}" method="POST" class="formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <button type="submit" class="btn btn-danger btn-sm btnEliminar">Eliminar</button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-5">
                                Tu pedido está vacío.
                                <br>
                                Vuelve al menú para añadir productos.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Resumen -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        Resumen del pedido
                    </div>
                    <div class="card-body">
                        <p class="d-flex justify-content-between">
                            <span class="fw-medium">Total:</span>
                            <span class="fw-bold text-primary fs-5">{{ number_format(session("total_$mesa_id", 0), 2) }}€</span>
                        </p>

                        <!-- Botón para hacer pedido -->
                        <form id="formHacerPedido" action="{{ route('hacer.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="productos" id="productosInput">
                            <button type="submit" class="btn btn-primary w-100" id="btnHacerPedido">
                                Confirmar Pedido
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Cuenta atrás -->
                <div id="countdown" class="card text-center shadow-sm mt-4 d-none">
                    <div class="card-body bg-info text-white">
                        <h5>Tu pedido llegará en</h5>
                        <span id="timer" class="fs-3 fw-bold"></span>
                        <span class="fs-5"> segundos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cuentaActiva = false;
            const countdownElement = document.getElementById('countdown');
            const timerElement = document.getElementById('timer');
            const btnEliminar = document.querySelectorAll('.btnEliminar');
            const btnHacerPedido = document.getElementById('btnHacerPedido');
            const btnVolverMenu = document.getElementById('btnVolverMenu');
            const listaProductos = document.getElementById('listaProductos');
            const productosInput = document.getElementById('productosInput');
            const formHacerPedido = document.getElementById('formHacerPedido');

            const estadoPedido = "{{ $estadoPedido ?? 'activo' }}";
            if (estadoPedido === 'pagando') {
                btnHacerPedido.disabled = true;
                btnEliminar.forEach(btn => btn.disabled = true);
                return;
            }

            if (listaProductos.children.length === 0) {
                btnHacerPedido.disabled = true;
            }

            btnHacerPedido.addEventListener('click', function (event) {
                if (cuentaActiva) return;

                cuentaActiva = true;
                let tiempo = listaProductos.children.length * 2;
                countdownElement.classList.remove('d-none');
                timerElement.textContent = tiempo;

                btnHacerPedido.disabled = true;
                btnEliminar.forEach(btn => btn.disabled = true);
                if (btnVolverMenu) btnVolverMenu.remove();

                const interval = setInterval(() => {
                    tiempo--;
                    timerElement.textContent = tiempo;

                    if (tiempo <= 0) {
                        clearInterval(interval);
                        countdownElement.innerHTML = '<h3 class="text-success">¡Tu pedido está listo!</h3>';
                        productosInput.value = JSON.stringify(@json($productosSession));
                        formHacerPedido.submit();
                    }
                }, 1000);
            });

            const formsEliminar = document.querySelectorAll('.formEliminar');
            formsEliminar.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const confirmacion = confirm('¿Estás seguro de que deseas eliminar este producto?');
                    if (confirmacion) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
