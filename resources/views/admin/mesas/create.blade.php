@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nueva Mesa</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mesas.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Mesa</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.mesas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
