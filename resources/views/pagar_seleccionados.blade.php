<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Pago Parcial</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .factura {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .factura::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0.5rem;
            background: linear-gradient(90deg, #3b82f6 0%, #2dd4bf 100%);
        }
        .factura-header {
            border-bottom: 2px dashed #e2e8f0;
            padding-bottom: 1.5rem;
        }
        .factura-footer {
            border-top: 2px dashed #e2e8f0;
            padding-top: 1.5rem;
        }
        .factura-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .factura-item:last-child {
            border-bottom: none;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .marcaAgua {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 8rem;
            color: rgba(226, 232, 240, 0.3);
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>
<body>
<div class="container mx-auto px-4 py-12 max-w-2xl">
    <div class="factura p-8 relative">
        <div class="marcaAgua">PAGADO</div>
        
        <!-- Encabezado de la factura -->
        <div class="factura-header text-center mb-8 relative z-10">
            <h2 class="text-2xl font-bold text-gray-800 uppercase mb-1">Factura de Pago</h2>
            <p class="text-gray-500">Gracias por tu visita</p>
        </div>

        <!-- Información de mesa y fecha -->
        <div class="flex justify-between mb-6 relative z-10">
            <div>
                <h5 class="font-bold text-gray-800">Mesa: {{ $mesa_id }}</h5>
            </div>
            <div class="text-right">
                <p class="mb-1 text-gray-600"><span class="font-semibold">Fecha:</span> {{ now()->format('d/m/Y') }}</p>
                <p class="text-gray-600"><span class="font-semibold">Hora:</span> {{ now()->format('H:i') }}</p>
            </div>
        </div>

        <!-- Productos pagados -->
        <div class="mb-8 relative z-10">
            <h4 class="text-center text-gray-700 font-semibold mb-4 pb-2 border-b">Productos Pagados</h4>
            <div class="space-y-1">
                @foreach($pagados as $producto)
                    <div class="factura-item flex justify-between items-center">
                        <span class="text-gray-700">{{ $producto['nombre'] }} <span class="text-gray-500">(x{{ $producto['cantidad'] ?? 1 }})</span></span>
                        <span class="font-bold text-gray-800">{{ number_format($producto['precio'], 2) }} €</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Total pagado -->
        <div class="factura-footer flex justify-end mb-6 relative z-10">
            <div class="text-right">
                <p class="text-xl font-bold text-gray-800">
                    Total Pagado: <span class="text-green-600">{{ number_format($total, 2) }} €</span>
                </p>
            </div>
        </div>

        <!-- Botón de continuar -->
        <div class="text-center mt-8 relative z-10">
            <a href="{{ route('confirmar.pedido', $pedido_id) }}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg>
                Continuar pagando
            </a>
        </div>
    </div>
</div>
</body>
</html>