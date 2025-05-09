@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Seleccionar Mesa</h1>
        <p class="lead text-muted">Por favor, selecciona una mesa para continuar con tu pedido.</p>
    </div>

    <!-- Advertencia si ya hay mesa activa -->
    @if(session()->has('mesa_id'))
        <div class="alert alert-warning text-center shadow-sm" role="alert">
            <strong>Atención:</strong> Ya tienes seleccionada la mesa <strong>{{ session('mesa_id') }}</strong>. 
            No puedes seleccionar otra hasta que completes el pedido.
        </div>
    @endif

    <!-- Listado de mesas -->
    <div class="row g-4">
        @foreach ($mesas as $mesa)
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold">Mesa {{ $mesa->nombre }}</h5>
                        <p class="card-text">
                            Estado: 
                            <span class="badge {{ $mesa->estado === 'Disponible' ? 'bg-success' : 'bg-danger' }}">
                                {{ $mesa->estado }}
                            </span>
                        </p>

                        @if ($mesa->estado === 'Disponible')
                            <form action="{{ route('seleccionar.mesa') }}" method="POST">
                                @csrf
                                <input type="hidden" name="mesa_id" value="{{ $mesa->id }}">
                                <button type="submit" class="btn btn-outline-primary btn-lg shadow-sm"
                                    @if(session()->has('mesa_id')) disabled @endif>
                                    Seleccionar
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline-secondary btn-lg shadow-sm" disabled>Ocupada</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection