@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Mesa</h2>
    <form action="{{ route('admin.mesas.update', $mesa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Mesa</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $mesa->nombre }}" required>
        </div>
        <button type="submit" class="btn btn-success" >Actualizar</button>
        <a href="{{ route('admin.mesas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection