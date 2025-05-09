<?php

use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MesaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Rutas protegidas con middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/agregar-pedido', [PedidoController::class, 'agregarProducto'])->name('agregar.pedido');
    Route::delete('/eliminar-pedido', [PedidoController::class, 'eliminarProducto'])->name('eliminar.pedido');
    Route::post('/pedido/guardar', [PedidoController::class, 'hacerPedido'])->name('hacer.pedido');
    Route::post('/pagar-todo', [PedidoController::class, 'pagarTodo'])->name('pagar.todo');
    Route::post('/pagar-separado', [PedidoController::class, 'pagarSeparado'])->name('pagar.separado');
    Route::get('/ver-pedido', [PedidoController::class, 'verPedido'])->name('ver.pedido');
    //confirmar pedido
    Route::get('/pedido/confirmar/{id}', [PedidoController::class, 'confirmarPedido'])->name('confirmar.pedido');
    //listar pedidos
    Route::get('/mis-pedidos', [PedidoController::class, 'listarPedidos'])->name('listar.pedidos');


    // Menú
    Route::get('/menu', [ProductoController::class, 'index'])->name('menu');
    
    //Seleccionar mesas
    Route::get('/seleccionar-mesa', [PedidoController::class, 'mostrarMesas'])->name('mostrar.mesas');
    Route::post('/seleccionar-mesa', [PedidoController::class, 'seleccionarMesa'])->name('seleccionar.mesa');
    
    // Liberar mesa
    Route::post('/admin/mesas/{mesa}/liberar', [MesaController::class, 'liberar'])->name('admin.mesas.liberar');

    // Cerrar sesión
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

Route::middleware(['auth', 'esadmin'])->prefix('admin')->name('admin.')->group(function () {
    // Mesas
    Route::get('/mesas', [MesaController::class, 'index'])->name('mesas.index');
    Route::get('/mesas/create', [MesaController::class, 'create'])->name('mesas.create');
    Route::post('/mesas', [MesaController::class, 'store'])->name('mesas.store');
    Route::get('/mesas/{mesa}/edit', [MesaController::class, 'edit'])->name('mesas.edit');
    Route::put('/mesas/{mesa}', [MesaController::class, 'update'])->name('mesas.update');
    Route::delete('/mesas/{mesa}', [MesaController::class, 'destroy'])->name('mesas.destroy');
    
});


Route::middleware(['auth', 'esadmin'])->prefix('admin')->name('admin.')->group(function () {
    // Productos
    Route::get('/productos', [AdminProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [AdminProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [AdminProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [AdminProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [AdminProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [AdminProductoController::class, 'destroy'])->name('productos.destroy');
});

//DEBATIR DI QUITARLO____________________________________________________________________________
// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//_______________________________________________________________________________________________

// Rutas de autenticación
require __DIR__.'/auth.php';