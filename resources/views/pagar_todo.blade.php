<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Pago</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-table th, .invoice-table td {
            text-align: center;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Encabezado de la factura -->
        <div class="invoice-header">
            <h1>Restaurante SmartOrder</h1>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
            <p><strong>Mesa:</strong> {{ session('mesa_id', 'N/A') }}</p>
        </div>

        <!-- Tabla de productos -->
        <table class="table table-bordered invoice-table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $index => $producto)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>{{ number_format($producto['precio'], 2) }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="text-end fs-5 mt-4">
            <strong>Total a pagar:</strong> {{ number_format($total, 2) }}€
        </div>

        <!-- Mensaje de agradecimiento -->
        <div class="invoice-footer">
            <h2>Gracias por su visita</h2>
            <p>¡Esperamos verle pronto!</p>
        </div>

        <!-- Botón para finalizar -->
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-success">Finalizar</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>