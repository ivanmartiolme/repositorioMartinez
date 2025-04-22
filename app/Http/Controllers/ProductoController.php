<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        // Página actual
        $paginaActual = $request->input('page', 1);

        // Obtener todos los productos desde la base de datos
        $productos = Producto::all();

        // Agrupar los productos por categoría
        $productosAgrupados = $productos->groupBy('categoria');

        // Dividir las categorías por página
        $menuPaginado = [];
        if ($paginaActual == 1) {
            $menuPaginado = [
                'desayunos_postres' => collect()
                    ->merge($productosAgrupados->get('desayunos', collect()))
                    ->merge($productosAgrupados->get('postres', collect())),
                'bocadillos' => $productosAgrupados->get('bocadillos', collect()),
                'sandwiches' => $productosAgrupados->get('sandwiches', collect()),
            ];
        } elseif ($paginaActual == 2) {
            $menuPaginado = [
                'hamburguesas' => $productosAgrupados->get('hamburguesas', collect()),
                'bebidas' => $productosAgrupados->get('bebidas', collect()),
            ];
        }

        // Calcular el número total de páginas
        $totalPaginas = 2;

        // Pasar los datos a la vista
        return view('menu', compact('menuPaginado', 'paginaActual', 'totalPaginas'));
    }
}