<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .header-gradient {
            background: linear-gradient(90deg, #3b82f6 0%, #2dd4bf 100%);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">

@php
    $pendientes = $pedido->detalles->filter(fn($d) => !in_array($d->id, $pagados));
@endphp

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="text-center mb-8">
        <div class="header-gradient">
            <h2 class="text-3xl font-bold text-white">Confirmación del Pedido</h2>
        </div>
    </div>

    @if($pedido->estado === 'Pagado')
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md text-center">
            <strong class="font-bold">¡Gracias!</strong> Este pedido ya ha sido pagado completamente.
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">Finalizar</a>
        </div>
    @else
        @if($pendientes->isEmpty())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-md shadow-md text-center">
                <strong class="font-bold">¡Gracias!</strong> Todos los productos han sido pagados.
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">Volver al Menú</a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h4 class="text-xl font-semibold text-center">Productos Pendientes de Pago</h4>
                </div>
                <div class="p-6">
                    <form action="{{ route('pagar.separado') }}" method="POST" id="formPagarSeleccionados">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <ul class="divide-y divide-gray-200 mb-6">
                            @foreach($pedido->detalles as $detalle)
                                @if(!in_array($detalle->id, $pagados))
                                    <li class="py-4 flex justify-between items-center">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="items[]" value="{{ $detalle->id }}" class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 mr-3">
                                            <span class="font-medium text-gray-800">{{ $detalle->producto->nombre }}</span>
                                        </div>
                                        <span class="text-gray-600 font-medium">{{ number_format($detalle->subtotal, 2) }} €</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="text-center">
                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">Pagar Seleccionados</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-6">
                <form action="{{ route('pagar.todo') }}" method="POST" id="formPagarTodo">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">Pagar Todo</button>
                </form>
            </div>
        @endif
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const formPagarSeleccionados = document.getElementById('formPagarSeleccionados');
    const formPagarTodo = document.getElementById('formPagarTodo');

    if (formPagarSeleccionados) {
        formPagarSeleccionados.addEventListener('submit', function (event) {
            const checkboxes = formPagarSeleccionados.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                event.preventDefault();
                alert('Para pagar seleccionados, debes marcar al menos un producto.');
            }
        });
    }

    if (formPagarTodo) {
        const totalPendientes = {{ $pendientes->count() }};
        formPagarTodo.addEventListener('submit', function (event) {
            if (totalPendientes === 0) {
                event.preventDefault();
                alert('Para pagar todo, debe haber al menos un producto pendiente.');
            }
        });
    }
});
</script>

</body>
</html>