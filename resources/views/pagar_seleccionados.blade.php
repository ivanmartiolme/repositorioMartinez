<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Pago Parcial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="text-uppercase text-primary fw-bold">Factura de Pago</h2>
        <p class="text-muted">Gracias por tu visita</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold">Mesa: {{ $mesa_id }}</h5>
                </div>
                <div class="text-end">
                    <p class="mb-0"><strong>Fecha:</strong> {{ now()->format('d/m/Y') }}</p>
                    <p class="mb-0"><strong>Hora:</strong> {{ now()->format('H:i') }}</p>
                </div>
            </div>

            <h4 class="text-center text-secondary mb-4">Productos Pagados</h4>
            <ul class="list-group list-group-flush">
                @foreach($pagados as $producto)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $producto['nombre'] }} (x{{ $producto['cantidad'] ?? 1 }})</span>
                        <span class="fw-bold">{{ number_format($producto['precio'], 2) }} €</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="text-end mb-4">
        <p class="fs-4 fw-bold">
            <strong>Total Pagado:</strong> <span class="text-success">{{ number_format($total, 2) }} €</span>
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('confirmar.pedido', $pedido_id) }}" class="btn btn-outline-primary btn-lg px-4 me-2">
            Continuar pagando
        </a>
    </div>
</div>
</body>
</html>
