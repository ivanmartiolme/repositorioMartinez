<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection; 

class ProductoController extends Controller
{
    public function index(Request $request)
{
    // Simular productos organizados por categorías
    $menu = [
        'desayunos_postres' => [
            ['id' => 1, 'nombre' => 'Café', 'precio' => 1.50],
            ['id' => 2, 'nombre' => 'Tarta de Chocolate', 'precio' => 3.00],
            ['id' => 3, 'nombre' => 'Tarta de Queso', 'precio' => 2.80],
            ['id' => 4, 'nombre' => 'Croissant', 'precio' => 1.80],
            ['id' => 5, 'nombre' => 'Zumo de Naranja', 'precio' => 2.50],
            ['id' => 6, 'nombre' => 'Tostada con Mermelada', 'precio' => 2.00],
            ['id' => 7, 'nombre' => 'Tostada con Tomate y Aceite', 'precio' => 2.20],
            ['id' => 8, 'nombre' => 'Churros', 'precio' => 2.50],
            ['id' => 9, 'nombre' => 'Bizcocho Casero', 'precio' => 3.00],
        ],
        'bocadillos' => [
            ['id' => 10, 'nombre' => 'Bocadillo de Jamón', 'precio' => 4.00],
            ['id' => 11, 'nombre' => 'Montado de Lomo', 'precio' => 2.50],
            ['id' => 12, 'nombre' => 'Bocadillo de Tortilla', 'precio' => 3.50],
            ['id' => 13, 'nombre' => 'Bocadillo de Atún', 'precio' => 3.80],
            ['id' => 14, 'nombre' => 'Montado de Bacon', 'precio' => 2.80],
            ['id' => 15, 'nombre' => 'Bocadillo Vegetal', 'precio' => 4.20],
            ['id' => 16, 'nombre' => 'Montado de Pollo', 'precio' => 3.00],
            ['id' => 17, 'nombre' => 'Bocadillo de Chorizo', 'precio' => 3.50],
            ['id' => 18, 'nombre' => 'Bocadillo de Calamares', 'precio' => 4.50],
            ['id' => 19, 'nombre' => 'Bocadillo de Especial', 'precio' => 5.50],
        ],
        'sandwiches' => [
            ['id' => 20, 'nombre' => 'Sándwich Mixto', 'precio' => 3.50],
            ['id' => 21, 'nombre' => 'Sándwich de Pollo', 'precio' => 4.00],
            ['id' => 22, 'nombre' => 'Sándwich de Atún', 'precio' => 4.20],
            ['id' => 23, 'nombre' => 'Sándwich de Jamón y Queso', 'precio' => 3.50],
            ['id' => 24, 'nombre' => 'Sándwich de Pollo al Curry', 'precio' => 4.50],
            ['id' => 25, 'nombre' => 'Sándwich Vegetal', 'precio' => 4.00],
            ['id' => 26, 'nombre' => 'Sándwich de Bacon y Queso', 'precio' => 4.50],
            ['id' => 27, 'nombre' => 'Sándwich de Huevo y Jamón', 'precio' => 4.20],
            ['id' => 28, 'nombre' => 'Sándwich de Salmón', 'precio' => 5.00],
            ['id' => 29, 'nombre' => 'Sándwich de Pavo', 'precio' => 4.80],
        ],
        'hamburguesas' => [
            ['id' => 30, 'nombre' => 'Hamburguesa', 'precio' => 5.00],
            ['id' => 31, 'nombre' => 'Hamburguesa con Queso', 'precio' => 5.50],
            ['id' => 32, 'nombre' => 'Hamburguesa Vegetal', 'precio' => 6.00],
            ['id' => 33, 'nombre' => 'Hamburguesa BBQ', 'precio' => 6.50],
            ['id' => 34, 'nombre' => 'Hamburguesa de Pollo', 'precio' => 5.80],
            ['id' => 35, 'nombre' => 'Hamburguesa Doble', 'precio' => 7.00],
        ],
        'bebidas' => [
        ['id' => 36, 'nombre' => 'Cerveza', 'precio' => 2.50],
        ['id' => 37, 'nombre' => 'Refresco', 'precio' => 2.00],
        ['id' => 38, 'nombre' => 'Agua Mineral', 'precio' => 1.50],
        ['id' => 39, 'nombre' => 'Tinto de Verano', 'precio' => 2.20],
        ['id' => 40, 'nombre' => 'Vino Tinto', 'precio' => 3.00],
        ['id' => 41, 'nombre' => 'Vino Blanco', 'precio' => 3.00],
        ['id' => 42, 'nombre' => 'Copa de Sangría', 'precio' => 2.80],
    ],
    ];

    // Página actual
    $paginaActual = $request->input('page', 1);

    // Dividir las categorías por página
    $menuPaginado = [];
    if ($paginaActual == 1) {
        $menuPaginado = [
            'desayunos_postres' => $menu['desayunos_postres'],
            'bocadillos' => $menu['bocadillos'],
            'sandwiches' => $menu['sandwiches'],
        ];
    } elseif ($paginaActual == 2) {
        $menuPaginado = [
            'hamburguesas' => $menu['hamburguesas'],
            'bebidas' => $menu['bebidas'],
        ];
    }

    // Calcular el número total de páginas
    $totalPaginas = 2;

    return view('menu', compact('menuPaginado', 'paginaActual', 'totalPaginas'));
}
}