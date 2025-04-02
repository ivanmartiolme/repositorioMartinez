@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Pedidos</h1>
    <table class="table">
        <thead>
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
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->mesa_id }}</td>
                    <td>{{ number_format($pedido->total, 2) }}€</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>
                        <ul>
                            @foreach($pedido->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad }} x {{ number_format($detalle->subtotal, 2) }}€</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection