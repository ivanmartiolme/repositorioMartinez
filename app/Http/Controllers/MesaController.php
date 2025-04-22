<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        // Obtener todas las mesas desde la base de datos
        $mesas = Mesa::all();
        return view('admin.mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('admin.mesas.create');
    }

    //Guardar una nueva mesa

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Mesa::create([
            'nombre' => $request->nombre,
            'estado' => 'Disponible', // Estado por defecto
        ]);

        return redirect()->route('admin.mesas.index')->with('mensaje', 'Mesa creada con éxito.');
    }

    // Mostrar el formulario para editar una mesa
    public function edit(Mesa $mesa)
    {
        return view('admin.mesas.edit', compact('mesa'));
    }

    // Actualizar una mesa existente
    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $mesa->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.mesas.index')->with('mensaje', 'Mesa actualizada con éxito.');
    }


    // Eliminar una mesa
    public function destroy(Mesa $mesa)
    {
        $mesa->delete();
        return redirect()->route('admin.mesas.index')->with('mensaje', 'Mesa eliminada con éxito.');
    }
    
    // Cambiar el estado de una mesa
    public function cambiarEstado(Mesa $mesa)
    {
        $mesa->estado = ($mesa->estado == 'Disponible') ? 'Ocupada' : 'Disponible';
        $mesa->save();

        return redirect()->route('admin.mesas.index')->with('mensaje', 'Estado de la mesa actualizado con éxito.');
    }

}
