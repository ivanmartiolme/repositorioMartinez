<?php
namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function agregarProducto(Request $request)
    {
        $mesa_id = $request->mesa_id;

        // Obtener el pedido actual de la sesión
        $pedido = session("pedido_$mesa_id", []);
        $total = session("total_$mesa_id", 0);

        // Simular el menú (en un caso real, esto vendría de la base de datos)
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
            'sandwiches_hamburguesas_bebidas' => [
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
                ['id' => 30, 'nombre' => 'Hamburguesa', 'precio' => 5.00],
                ['id' => 31, 'nombre' => 'Hamburguesa con Queso', 'precio' => 5.50],
                ['id' => 32, 'nombre' => 'Hamburguesa Vegetal', 'precio' => 6.00],
                ['id' => 33, 'nombre' => 'Hamburguesa BBQ', 'precio' => 6.50],
                ['id' => 34, 'nombre' => 'Hamburguesa de Pollo', 'precio' => 5.80],
                ['id' => 35, 'nombre' => 'Hamburguesa Doble', 'precio' => 7.00],
                ['id' => 36, 'nombre' => 'Cerveza', 'precio' => 2.50],
                ['id' => 37, 'nombre' => 'Refresco', 'precio' => 2.00],
                ['id' => 38, 'nombre' => 'Agua Mineral', 'precio' => 1.50],
                ['id' => 39, 'nombre' => 'Tinto de Verano', 'precio' => 2.20],
                ['id' => 40, 'nombre' => 'Vino Tinto', 'precio' => 3.00],
                ['id' => 41, 'nombre' => 'Vino Blanco', 'precio' => 3.00],
                ['id' => 42, 'nombre' => 'Copa de Sangría', 'precio' => 2.80],            
            ],
        ];

        // Buscar el producto en el menú por su ID
        $producto = collect($menu['desayunos_postres'])
        ->merge($menu['bocadillos'])
        ->merge($menu['sandwiches_hamburguesas_bebidas'])
        ->firstWhere('id', (int) $request->pedido);

        if ($producto) {

            $producto['unique_id'] = uniqid(); // Generar un ID único para el producto

            // Agregar el producto al pedido
            $pedido[] = $producto;
            $total += $producto['precio'];

            // Guardar el pedido actualizado en la sesión
            session(["pedido_$mesa_id" => $pedido, "total_$mesa_id" => $total]);

            // Restablecer el estado del pedido
            session(['estado_pedido' => 'activo']);
        }

        return redirect()->back()->with('mensaje', 'Producto agregado al pedido.');
    }

    public function pagarTodo(Request $request)
    {
        $productos = session('pedido_1', []);

        // Validar si hay productos en la lista
        if (empty($productos)) {
            return redirect()->back()->with('error', 'Para pagar todo, debe haber al menos un producto en la lista.');
        }

        $total = array_sum(array_column($productos, 'precio'));

        // Limpiar la lista de productos
        session()->forget('pedido_1');
        session()->forget('total_1');

        return view('pagar_todo', compact('productos', 'total'));
    }

    public function pagarSeparado(Request $request)
    {
        $mesa_id = 1; // Simulamos Mesa 1
        $productos = session('pedido_1', []);
        $seleccionados = $request->input('items', []);

        if (empty($seleccionados)) {
            return redirect()->back()->with('error', 'Para pagar por separado, debe seleccionar al menos un producto.');
        }

        $pagados = [];
        foreach ($productos as $index => $producto) {
            if (in_array($producto['unique_id'], $seleccionados)) {
                $pagados[] = $producto;
                unset($productos[$index]);
            }
        }

        // Actualizar la lista de productos en la sesión
        session(['pedido_1' => $productos]);
        session(['total_1' => array_sum(array_column($productos, 'precio'))]);

        // Establecer una bandera para deshabilitar botones
        session(['estado_pedido' => 'pagando']);

        $total = array_sum(array_column($pagados, 'precio'));

        return view('pagar_seleccionados', compact('pagados', 'total'));
    }

    public function listarPedidos()
    {
        $pedidos = Pedido::with('detalles')->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function finalizar()
    {
        return redirect()->route('menu'); // Redirigir al menú principal
    }


    public function verPedido()
    {
        // Obtener los productos del pedido desde la sesión
        $productos = session('pedido_1', []);
        $total = session('total_1', 0);
        $estadoPedido = session('estado_pedido', 'activo'); // Por defecto, el estado es "activo"

        // Pasar los datos a la vista
        return view('pedido', compact('productos', 'total', 'estadoPedido'));
    }

    public function eliminarProducto(Request $request)
    {
        $mesa_id = 1; // Simulamos Mesa 1
        $pedido = session("pedido_$mesa_id", []);
        $total = session("total_$mesa_id", 0);

        // Eliminar el producto del pedido
        if (isset($pedido[$request->index])) {
            $total -= $pedido[$request->index]['precio'];
            unset($pedido[$request->index]);
        }

        // Actualizar la sesión
        session(["pedido_$mesa_id" => array_values($pedido), "total_$mesa_id" => $total]);

        return redirect()->back()->with('mensaje', 'Producto eliminado del pedido.');
    }

    public function hacerPedido(Request $request)
    {
        $mesa_id = $request->mesa_id;

        // Obtener el pedido actual de la sesión
        $pedido = session("pedido_$mesa_id", []);
        $total = session("total_$mesa_id", 0);

        dd($pedido, $total);

        if (empty($pedido)) {
            return redirect()->back()->with('error', 'No hay productos en el pedido.');
        }

        $nuevoPedido = Pedido::create([
            'mesa_id' => $mesa_id,
            'total' => $total,
            'estado' => 'pendiente',
        ]);

        dd($nuevoPedido);

        // Crear los detalles del pedido
        $detallesAgrupados = [];
        foreach ($pedido as $producto) {
            if (isset($detallesAgrupados[$producto['id']])) {
                $detallesAgrupados[$producto['id']]['cantidad']++;
                $detallesAgrupados[$producto['id']]['subtotal'] += $producto['precio'];
            } else {
                $detallesAgrupados[$producto['id']] = [
                    'producto_id' => $producto['id'],
                    'cantidad' => 1,
                    'subtotal' => $producto['precio'],
                ];
            }
        }

        foreach ($detallesAgrupados as $detalle) {
            $nuevoPedido->detalles()->create([
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'subtotal' => $detalle['subtotal'],
            ]);
        }

        // Limpiar el pedido de la sesión
        session()->forget("pedido_$mesa_id");
        session()->forget("total_$mesa_id");

        // Calcular el tiempo de preparación (por ejemplo, 10 segundos por producto)
        $tiempoPreparacion = count($pedido) * 10;

        // Simular el envío del pedido a la cocina
        session()->flash('mensaje', 'El pedido ha sido enviado a la cocina.');

        // Pasar el tiempo de preparación a la vista
        return redirect()->back()->with('tiempoPreparacion', $tiempoPreparacion);
    }
}