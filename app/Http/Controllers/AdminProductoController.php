<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    // Mostrar la lista de productos
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // Mostrar el formulario para crear un producto
    public function create()
    {
        $categorias = ['desayunos', 'postres', 'bocadillos', 'sandwiches', 'hamburguesas', 'bebidas'];
        return view('admin.productos.create', compact('categorias'));
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|string|in:desayunos,postres,bocadillos,sandwiches,hamburguesas,bebidas',
        ]);

        Producto::create($request->only(['nombre', 'precio', 'categoria']));

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto creado con éxito.');
    }

    // Mostrar el formulario para editar un producto
    public function edit(Producto $producto)
    {
        $categorias = ['desayunos', 'postres', 'bocadillos', 'sandwiches', 'hamburguesas', 'bebidas'];
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar un producto existente
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|string|in:desayunos,postres,bocadillos,sandwiches,hamburguesas,bebidas',
        ]);

        $producto->update($request->all());

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado con éxito.');
    }
}