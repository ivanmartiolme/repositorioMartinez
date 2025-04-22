@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">👋 Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-center text-muted">Selecciona una de las opciones para gestionar tu aplicación.</p>

        <div class="row g-4">
            <!-- Ver Productos -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">🛒 Ver Productos</h5>
                        <p class="card-text">Gestiona los productos disponibles en tu sistema.</p>
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Ir a Productos</a>
                    </div>
                </div>
            </div>

            <!-- Gestionar Mesas -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">🍽️ Gestionar Mesas</h5>
                        <p class="card-text">Administra las mesas de tu restaurante de manera eficiente.</p>
                        <a href="{{ route('admin.mesas.index') }}" class="btn btn-primary">Ir a Mesas</a>
                    </div>
                </div>
            </div>

            <!-- Ver Menú -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">📋 Ver Menú</h5>
                        <p class="card-text">Consulta el menú disponible para los clientes.</p>
                        <a href="{{ route('menu') }}" class="btn btn-primary">Ir al Menú</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection