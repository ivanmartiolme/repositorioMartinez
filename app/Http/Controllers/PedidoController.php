<?php
namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    //AGREGAR PRODUCTO AL PEDIDO
    public function agregarProducto(Request $request)
    {
        // Obtener el ID de la mesa desde el formulario o la sesión
        $mesa_id = session('mesa_id');

        if (!$mesa_id) {
            return redirect()->route('menu')->with('error', 'Por favor, selecciona una mesa antes de agregar productos.');
        }

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
            session([
                "pedido_$mesa_id" => $pedido,
                "total_$mesa_id" => $total
            ]);
        }

        return redirect()->back()->with('mensaje', 'Producto agregado al pedido.');
    }

    //PAGAR TODO EL PEDIDO
    public function pagarTodo(Request $request)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($request->pedido_id);
        // Obtener detalles ya pagados desde sesión
        $yaPagados = session('pagados_' . $pedido->id, []);
        // Filtrar los detalles no pagados
        $pendientes = $pedido->detalles->whereNotIn('id', $yaPagados);

        if ($pendientes->isEmpty()) {
            return redirect()->route('menu')->with('mensaje', 'Todos los productos ya están pagados.');
        }
        // Armar los productos a mostrar
        $productos = $pendientes->map(function ($detalle) {
            return [
                'id' => $detalle->producto->id,
                'nombre' => $detalle->producto->nombre,
                'precio' => $detalle->subtotal,
                'cantidad' => $detalle->cantidad,
            ];
        });

        $total = $productos->sum('precio');
        // Marcar como pagados
        foreach ($pendientes as $detalle) {
            $yaPagados[] = $detalle->id;
        }
        session(['pagados_' . $pedido->id => $yaPagados]);
        // Verificar si ya se pagó todo el pedido
        $totalDetalles = $pedido->detalles()->count();
        if (count($yaPagados) >= $totalDetalles) {
            $pedido->estado = 'Pagado';
            $pedido->save();
            //Liberar la mesa
            $mesa = $pedido->mesa;
            $mesa->estado = 'Disponible';
            $mesa->save();
            // Limpiar sesión de pedido
            session()->forget("pedido_" . $pedido->mesa_id);
            session()->forget("total_" . $pedido->mesa_id);
            session()->forget("pagados_" . $pedido->id);
            session()->forget("mesa_id");
        }
        // Aquí defines mesa_id antes de enviarlo a la vista
        $mesa_id = $pedido->mesa_id;
        return view('pagar_todo', compact('productos', 'total', 'mesa_id'));
    }

    //PAGAR POR PARTES EL PEDIDO
    public function pagarSeparado(Request $request)
    {
        $detalleIds = $request->input('items', []);

        if (empty($detalleIds)) {
            return redirect()->back()->with('error', 'Para pagar por separado, debe seleccionar al menos un producto.');
        }

        $detalles = DetallePedido::with(['producto', 'pedido'])->whereIn('id', $detalleIds)->get();

        $pagados = $detalles->map(function ($detalle) {
            return [
                'nombre' => $detalle->producto->nombre,
                'precio' => $detalle->subtotal,
                'cantidad' => $detalle->cantidad,
            ];
        });

        $total = $pagados->sum('precio');
        $pedido = $detalles->first()->pedido;
        $mesa_id = $pedido->mesa_id;

        // Guardar los IDs pagados en sesión
        $yaPagados = session('pagados_' . $pedido->id, []);
        $yaPagados = array_merge($yaPagados, $detalleIds);
        session(['pagados_' . $pedido->id => $yaPagados]);

        // Verificar si ya se pagó todo el pedido
        $totalDetalles = $pedido->detalles()->count();
        if (count($yaPagados) >= $totalDetalles) {
            $pedido->estado = 'Pagado';
            $pedido->save();

            // Liberar la mesa
            $mesa = $pedido->mesa;
            $mesa->estado = 'Disponible';
            $mesa->save();

            // Limpiar la sesión del pedido
            session()->forget("pedido_" . $mesa->id);
            session()->forget("total_" . $mesa->id);
            session()->forget("pagados_" . $pedido->id);
            session()->forget("mesa_id");
        }

        return view('pagar_seleccionados', [
            'pagados' => $pagados,
            'total' => $total,
            'pedido_id' => $pedido->id,
            'mesa_id' => $mesa_id
        ]);
    }

    //LISTAR PEDIDOS DEL USUARIO
    public function listarPedidos()
    {
        $pedidos = Pedido::where('user_id', auth()->id())->with('detalles.producto')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    //FUNCION QUE NOS PERMITE VER EL PEDIDO
    public function verPedido()
    {
        $mesa_id = session('mesa_id');

        if (!$mesa_id) {
            return redirect()->route('menu')->with('error', 'Por favor, selecciona una mesa antes de ver el pedido.');
        }

        $productos = session("pedido_$mesa_id", []);
        $total = session("total_$mesa_id", 0);

        $estadoPedido = session('estado_pedido', 'activo');

        return view('pedido', compact('productos', 'total', 'estadoPedido'));
    }
    
    //FUNCION QUE NOS PERMITE ELIMINAR UN PRODUCTO DEL PEDIDO
    //A LA HORA DE ELIMINAR NOS MUESTRA UN ALERT PREGUNTANDO SI QUEREMOS ELIMINARLO
    public function eliminarProducto(Request $request)
    {
        $mesa_id = session('mesa_id');
        $pedido = session("pedido_$mesa_id", []);
        $total = session("total_$mesa_id", 0);

        if (isset($pedido[$request->index])) {
            $total -= $pedido[$request->index]['precio'];
            unset($pedido[$request->index]);
        }

        session([
            "pedido_$mesa_id" => array_values($pedido),
            "total_$mesa_id" => $total
        ]);

        return redirect()->back()->with('mensaje', 'Producto eliminado del pedido.');
    }

    //FUNCION QUE NOS PERMITE HACER UN PEDIDO
    public function hacerPedido(Request $request)
    {
        if (!session()->has('mesa_id')) {
            return redirect()->route('menu')->with('error', 'Debe seleccionar una mesa antes de hacer un pedido.');
        }

        $mesa_id = session('mesa_id'); // Solo desde sesión

        $productos = json_decode($request->input('productos'), true);

        if (empty($productos)) {
            return redirect()->back()->with('error', 'No hay productos en el pedido.');
        }

        $total = array_sum(array_column($productos, 'precio'));

        try {
            Log::info('Iniciando creación de pedido para mesa ' . $mesa_id);

            $nuevoPedido = Pedido::create([
                'mesa_id' => $mesa_id,
                'user_id' => auth()->id(),
                'total' => $total,
                'estado' => 'Pendiente',
            ]);

            Log::info('Pedido creado con ID: ' . $nuevoPedido->id);

            foreach ($productos as $producto) {
                $nuevoPedido->detalles()->create([
                    'producto_id' => $producto['id'],
                    'cantidad' => 1,
                    'subtotal' => $producto['precio'],
                ]);
            }

            return redirect()->route('confirmar.pedido', $nuevoPedido->id);

        } catch (\Exception $e) {
            Log::error('Error al crear el pedido: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al guardar el pedido. Seleccione una mesa.');
        }
    }

    //FUNCION QUE TRAS CONFIRMAR EL PEDIDO CAMBIA EL ESTADO DEL PEDIDO DE PENDIENTE A PAGADO
    public function confirmarPedido($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);

        $pagados = session('pagados_' . $pedido->id, []);

        // Si ya se han pagado todos los productos, marcar el pedido como pagado
        $productosPendientes = $pedido->detalles->whereNotIn('id', $pagados);

        if ($productosPendientes->isEmpty() && $pedido->estado !== 'Pagado') {
            $pedido->estado = 'Pagado';
            $pedido->save();

            // Limpiar sesión relacionada con este pedido
            session()->forget("pedido_{$pedido->mesa_id}");
            session()->forget("total_{$pedido->mesa_id}");
            session()->forget("pagados_{$pedido->id}");
        }

        return view('confirmar_pedido', compact('pedido', 'pagados'));
    }

    //FUNCION QUE NOS MUESTRA LAS MESAS
    public function mostrarMesas()
    {
        $mesas = Mesa::all(); // Obtén todas las mesas
        return view('seleccionar_mesa', compact('mesas'));
    }

    //FUNCION QUE NOS DEJA SELECCIONAR UNA MESA ANTES DE HACER EL PEDIDO
    public function seleccionarMesa(Request $request)
    {
        $mesa = Mesa::findOrFail($request->mesa_id);

        if ($mesa->estado === 'Ocupada') {
            return redirect()->back()->with('mensaje', 'Esa mesa ya está ocupada. Por favor, elige otra.');
        }

        // Marcar la mesa como ocupada
        $mesa->estado = 'Ocupada';
        $mesa->save();

        // Guardar la mesa en la sesión del cliente
        session(['mesa_id' => $mesa->id]);

        return redirect()->route('menu')->with('mensaje', 'Mesa seleccionada correctamente.');
    }

}