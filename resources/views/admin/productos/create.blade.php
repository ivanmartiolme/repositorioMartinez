@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
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
    </form>
</div>
@endsection