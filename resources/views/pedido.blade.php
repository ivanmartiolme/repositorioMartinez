<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pedido</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .pedido-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .countdown {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>
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
        <div class="pedido-header">
            <h1>Mi Pedido</h1>
            <p>Revisa los productos seleccionados y elige una opción de pago</p>
        </div>

        <!-- Lista de productos -->
        <div class="card mb-4">
            <div class="card-body">
                <ul class="list-group" id="listaProductos">
                    @foreach(session("pedido_1", []) as $index => $item)
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
        <p class="text-end fs-5"><strong>Total: </strong> {{ number_format(session("total_1", 0), 2) }}€</p>

        <!-- Opciones de Pago -->
        <h2 class="mb-3">Opciones de Pago</h2>
        <div class="d-flex gap-3">
            <form action="{{ route('pagar.todo') }}" method="POST" id="formPagarTodo">
                @csrf
                <button type="submit" class="btn btn-primary" id="btnPagarTodo" disabled>Pagar Todo</button>
            </form>

            <form action="{{ route('pagar.separado') }}" method="POST" id="formPagarSeleccionados">
                @csrf
                <ul class="list-group mb-3">
                    @foreach(session("pedido_1", []) as $item)
                        <li class="list-group-item">
                            <input type="checkbox" name="items[]" value="{{ $item['unique_id'] }}" class="form-check-input me-2 checkboxProducto">
                            {{ $item['nombre'] }} - {{ number_format($item['precio'], 2) }}€
                        </li>
                    @endforeach
                </ul>
                <button type="submit" class="btn btn-secondary" id="btnPagarSeleccionados" disabled>Pagar Seleccionados</button>
            </form>
        </div>

        <!-- Botón para volver al menú -->
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-success" id="btnVolverMenu">Volver al Menú</a>
        </div>

        <!-- Botón para hacer el pedido -->
        <div class="text-center mt-4">
            <form id="formHacerPedido">
                @csrf
                <input type="hidden" name="mesa_id" value="1">
                <button type="button" class="btn btn-warning" id="btnHacerPedido">Hacer Pedido</button>
            </form>
        </div>

        <!-- Mensaje de cuenta atrás -->
        <div id="countdown" class="text-center mt-4 countdown" style="display: none;">
            <h3>Tu pedido llegará en <span id="timer"></span> segundos</h3>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cuentaActiva = false; // Variable para evitar múltiples inicios de cuenta atrás
            const countdownElement = document.getElementById('countdown');
            const timerElement = document.getElementById('timer');
            const btnPagarTodo = document.getElementById('btnPagarTodo');
            const btnPagarSeleccionados = document.getElementById('btnPagarSeleccionados');
            const btnEliminar = document.querySelectorAll('.btnEliminar');
            const btnHacerPedido = document.getElementById('btnHacerPedido');
            const btnVolverMenu = document.getElementById('btnVolverMenu'); // Botón "Volver al Menú"
            const listaProductos = document.getElementById('listaProductos');
            const formPagarSeleccionados = document.getElementById('formPagarSeleccionados');
            const checkboxesProductos = document.querySelectorAll('.checkboxProducto');

            // Verificar si el estado del pedido es "pagando"
            const estadoPedido = "{{ $estadoPedido ?? 'activo' }}";
            if (estadoPedido === 'pagando') {
                btnHacerPedido.disabled = true;
                btnEliminar.forEach(btn => btn.disabled = true);
                checkboxesProductos.forEach(checkbox => checkbox.disabled = false);
                btnPagarTodo.disabled = false;
                btnPagarSeleccionados.disabled = false;
                btnVolverMenu.disabled = true; // Deshabilitar "Volver al Menú"
                return; // Salir de la lógica inicial
            }

            // Verificar si hay productos en la lista al cargar la página
            function actualizarEstadoBotones() {
                if (listaProductos.children.length === 0) {
                    // No hay productos en la lista
                    btnHacerPedido.disabled = true;
                    btnPagarTodo.disabled = true;
                    btnPagarSeleccionados.disabled = true;
                    btnVolverMenu.disabled = false; // Habilitar "Volver al Menú" si no hay productos
                } else {
                    // Hay productos en la lista
                    btnHacerPedido.disabled = false;
                    btnPagarTodo.disabled = true;
                    btnPagarSeleccionados.disabled = true;
                    btnVolverMenu.disabled = true; // Deshabilitar "Volver al Menú" si hay productos
                }
            }

            actualizarEstadoBotones(); // Llamar al cargar la página

            // Manejar el clic en el botón "Hacer Pedido"
            btnHacerPedido.addEventListener('click', function () {
                if (cuentaActiva) return;

                cuentaActiva = true;

                const cantidadProductos = listaProductos.children.length;
                let tiempo = cantidadProductos * 5; // 5 segundos por producto
                countdownElement.style.display = 'block';
                timerElement.textContent = tiempo;

                btnHacerPedido.disabled = true;
                btnEliminar.forEach(btn => btn.disabled = true);
                btnVolverMenu.disabled = true; // Deshabilitar "Volver al Menú"

                const interval = setInterval(() => {
                    tiempo--;
                    timerElement.textContent = tiempo;

                    if (tiempo <= 0) {
                        clearInterval(interval);
                        countdownElement.innerHTML = '<h3>¡Tu pedido está listo!</h3>';
                        btnPagarTodo.disabled = false;
                        btnPagarSeleccionados.disabled = false;

                        // Habilitar los checkboxes de los productos
                        checkboxesProductos.forEach(checkbox => {
                            checkbox.disabled = false;
                        });
                    }
                }, 1000);
            });

            // Confirmar antes de eliminar un producto
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

            // Validar "Pagar Todo"
            btnPagarTodo.addEventListener('click', function (event) {
                if (listaProductos.children.length === 0) {
                    event.preventDefault();
                    alert('Para pagar todo, debe haber al menos un producto en la lista.');
                } else {
                    btnVolverMenu.disabled = false; // Habilitar "Volver al Menú" después de pagar todo
                }
            });

            // Validar "Pagar Seleccionados"
            formPagarSeleccionados.addEventListener('submit', function (event) {
                const checkboxes = formPagarSeleccionados.querySelectorAll('input[type="checkbox"]:checked');
                if (checkboxes.length === 0) {
                    event.preventDefault();
                    alert('Para pagar por separado, debe seleccionar al menos un producto.');
                } else if (listaProductos.children.length === checkboxes.length) {
                    btnVolverMenu.disabled = false; // Habilitar "Volver al Menú" si se pagan todos los productos
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>