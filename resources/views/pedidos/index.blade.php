@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Pedidos</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Mesa</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="text-center">{{ $pedido->id }}</td>
                        <td class="text-center">{{ $pedido->mesa_id }}</td>
                        <td class="text-end">{{ number_format($pedido->total, 2) }}€</td>
                        <td class="text-center">
                            <span class="badge {{ $pedido->estado === 'Pagado' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $pedido->estado }}
                            </span>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($pedido->detalles as $detalle)
                                    <li>
                                        <strong>{{ $detalle->producto->nombre }}</strong> - 
                                        {{ $detalle->cantidad }} x {{ number_format($detalle->subtotal, 2) }}€
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection