@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestión de Mesas</h2>
        <a href="{{ route('admin.mesas.create') }}" class="btn btn-success">➕ Crear Mesa</a>
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
                    <th style="width: 15%;">Estado</th>
                    <th style="width: 35%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mesas as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td class="text-start">{{ $m->nombre }}</td>
                        <td>
                            <span class="badge {{ $m->estado == 'Disponible' ? 'bg-success' : 'bg-danger' }}">
                                {{ $m->estado }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.mesas.edit', $m) }}" class="btn btn-outline-primary btn-sm me-2">
                                ✏️ Editar
                            </a>
                            <form action="{{ route('admin.mesas.destroy', $m->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta mesa?')">
                                    🗑️ Eliminar
                                </button>
                            </form>
                            @if($m->estado == 'Ocupada')
                                <form action="{{ route('admin.mesas.liberar', $m->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Liberar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">No hay mesas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection