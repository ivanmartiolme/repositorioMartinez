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

        // Buscar el producto en la base de datos por su ID
        $producto = Producto::find($request->pedido);

        if ($producto) {
            // Convertir el producto en un array para la sesión
            $productoArray = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'unique_id' => uniqid(), // Generar un ID único para el producto
            ];

            // Agregar el producto al pedido
            $pedido[] = $productoArray;
            $total += $producto->precio;

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
        $mesa_id = session('mesa_id');
        if (!$mesa_id) {
            return redirect()->route('menu')->with('mensaje', 'Por favor, selecciona una mesa antes de hacer un pedido.');
        }

        Pedido::create([
            'mesa_id' => $mesa_id
        ]);
    
        return redirect()->route('confirmacion.pedido')->with('mensaje', 'Pedido realizado con éxito.');

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
/*
    public function seleccionarMesa(Request $request)
    {
        $mesa = Mesa::findOrFail($request->mesa_id);

        if ($mesa->estado === 'Ocupada') {
            return redirect()->back()->with('mensaje', 'Esa mesa ya está ocupada. Elige otra.');
        }

        // Marcar la mesa como ocupada
        $mesa->estado = 'Ocupada';
        $mesa->save();

        // Guardar la mesa en la sesión del cliente
        session(['mesa_id' => $mesa->id]);

        return redirect()->route('menu')->with('mensaje', 'Mesa seleccionada correctamente.');
    }

    public function liberarMesa(Pedido $pedido)
    {
        $pedido->mesa->estado = 'Disponible';
        $pedido->mesa->save();

        return redirect()->route('admin.mesas.index')->with('mensaje', 'Mesa liberada correctamente.');
    }
*/
}