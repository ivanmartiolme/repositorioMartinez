@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lista de Mesas</h2>
    <a href="{{ route('admin.mesas.create') }}" class="btn btn-primary mb-3">Agregar Mesa</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mesas as $m)
            <tr>
                <td>{{ $m->nombre }}</td>
                <td>
                    <span class="badge {{ $m->estado == 'Disponible' ? 'bg-success' : 'bg-danger' }}">
                        {{ $m->estado }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.mesas.edit', $m->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.mesas.destroy', $m->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection