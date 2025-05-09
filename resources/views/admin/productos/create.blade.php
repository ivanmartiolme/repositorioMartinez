@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf
        <div class="mb-3"><br>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
        </div>
        <div class="mb-3">
            <input type="number" name="precio" id="precio" class="form-control" step="0.01"  placeholder="Precio" required>
        </div>
        <div class="mb-3">
            <select name="categoria" id="categoria" class="form-select" required>
                <option value="desayunos">Desayunos</option>
                <option value="postres">Postres</option>
                <option value="bocadillos">Bocadillos</option>
                <option value="sandwiches">Sandwiches</option>
                <option value="hamburguesas">Hamburguesas</option>
                <option value="bebidas">Bebidas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection