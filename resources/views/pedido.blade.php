<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .pedido-header { background-color: #007bff; color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; text-align: center; }
        .card { border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .list-group-item { border: none; border-bottom: 1px solid #ddd; }
        .list-group-item:last-child { border-bottom: none; }
        .btn-primary { background-color: #007bff; border: none; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-danger { background-color: #dc3545; border: none; }
        .btn-danger:hover { background-color: #c82333; }
        .btn-warning { background-color: #ffc107; border: none; }
        .btn-warning:hover { background-color: #e0a800; }
        .countdown { font-size: 1.5rem; font-weight: bold; color: #28a745; }
    </style>
</head>
<body class="bg-light">

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

        <div class="pedido-header">
            <h1>Mi Pedido</h1>
            <p>Revisa los productos seleccionados y haz clic en Hacer Pedido para confirmar</p>
        </div>

        <!-- Lista de productos -->
        <div class="card mb-4">
            <div class="card-body">
                <ul class="list-group" id="listaProductos">
                    @foreach($productosSession as $index => $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€</span>
                            <form action="{{ route('eliminar.pedido') }}" method="POST" class="d-inline formEliminar">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="index" value="{{ $index }}">
                                <button type="submit" class="btn btn-danger btn-sm btnEliminar">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Total -->
        <p class="text-end fs-5"><strong>Total: </strong> {{ number_format(session("total_$mesa_id", 0), 2) }}€</p>

        <!-- Botón para volver al menú -->
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-success" id="btnVolverMenu">Volver al Menú</a>
        </div>

        <!-- Botón para hacer el pedido -->
        <div class="text-center mt-4">
            <form id="formHacerPedido" action="{{ route('hacer.pedido') }}" method="POST">
                @csrf
                <input type="hidden" name="productos" id="productosInput">
                <button type="submit" class="btn btn-warning" id="btnHacerPedido">Hacer Pedido</button>
            </form>
        </div>

        <!-- Cuenta atrás -->
        <div id="countdown" class="text-center mt-4 countdown" style="display: none;">
            <h3>Tu pedido llegará en <span id="timer"></span> segundos</h3>
        </div>
    </div>

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

                const cantidadProductos = listaProductos.children.length;
                let tiempo = cantidadProductos * 2;
                countdownElement.style.display = 'block';
                timerElement.textContent = tiempo;

                btnHacerPedido.disabled = true;
                btnEliminar.forEach(btn => btn.disabled = true);
                if (btnVolverMenu) btnVolverMenu.remove();

                const interval = setInterval(() => {
                    tiempo--;
                    timerElement.textContent = tiempo;

                    if (tiempo <= 0) {
                        clearInterval(interval);
                        countdownElement.innerHTML = '<h3>¡Tu pedido está listo!</h3>';
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