<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

@php
    $pendientes = $pedido->detalles->filter(fn($d) => !in_array($d->id, $pagados));
@endphp

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 text-primary fw-bold">Confirmación del Pedido</h2>
    </div>

    @if($pedido->estado === 'Pagado')
        <div class="alert alert-success text-center shadow-sm">
            <strong>¡Gracias!</strong> Este pedido ya ha sido pagado completamente.
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg shadow-sm">Finalizar</a>
        </div>
    @else
        @if($pendientes->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                <strong>¡Gracias!</strong> Todos los productos han sido pagados.
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg shadow-sm">Volver al Menú</a>
            </div>
        @else
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h4 class="card-title text-center text-primary fw-bold mb-4">Productos Pendientes de Pago</h4>
                    <form action="{{ route('pagar.separado') }}" method="POST" id="formPagarSeleccionados">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($pedido->detalles as $detalle)
                                @if(!in_array($detalle->id, $pagados))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="checkbox" name="items[]" value="{{ $detalle->id }}" class="form-check-input me-2">
                                            <strong>{{ $detalle->producto->nombre }}</strong>
                                        </div>
                                        <span class="text-muted">{{ number_format($detalle->subtotal, 2) }} €</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary btn-lg shadow-sm">Pagar Seleccionados</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <form action="{{ route('pagar.todo') }}" method="POST" id="formPagarTodo">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">Pagar Todo</button>
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
