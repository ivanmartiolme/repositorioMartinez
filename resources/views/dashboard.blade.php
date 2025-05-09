@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <!-- Título de bienvenida -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="lead text-muted">Selecciona una de las opciones para gestionar tu aplicación de manera eficiente.</p>
    </div>

    <!-- Mensajes de error -->
    @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Opciones de gestión -->
    <div class="row g-4">
        {{-- Opciones solo para administradores --}}
        @if(Auth::user()->esAdmin())
            <!-- Ver Productos -->
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold">🛒 Ver Productos</h5>
                        <p class="card-text text-muted">Gestiona los productos disponibles en tu sistema.</p>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-primary btn-lg">Ir a Productos</a>
                    </div>
                </div>
            </div>

            <!-- Gestionar Mesas -->
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold">🍽️ Gestionar Mesas</h5>
                        <p class="card-text text-muted">Administra las mesas de tu restaurante de manera eficiente.</p>
                        <a href="{{ route('admin.mesas.index') }}" class="btn btn-outline-primary btn-lg">Ir a Mesas</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Ver Menú (disponible para todos los usuarios) -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary fw-bold">📋 Ver Menú</h5>
                    <p class="card-text text-muted">Consulta el menú disponible para los clientes.</p>
                    <a href="{{ route('menu') }}" class="btn btn-outline-primary btn-lg">Ir al Menú</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection