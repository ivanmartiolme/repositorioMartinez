@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestión de Productos</h2>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">➕ Crear Producto</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 25%;">Nombre</th>
                    <th style="width: 15%;">Precio</th>
                    <th style="width: 20%;">Categoría</th>
                    <th style="width: 35%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td class="text-start">{{ $producto->nombre }}</td>
                        <td>{{ number_format($producto->precio, 2) }}€</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($producto->categoria) }}</span></td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-outline-primary btn-sm me-2">
                                ✏️ Editar
                            </a>
                            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
