<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Ruta para mostrar el menú
Route::get('/menu', [ProductoController::class, 'index'])->name('menu');

// Ruta para agregar productos al pedido
Route::post('/agregar-pedido', [PedidoController::class, 'agregarProducto'])->name('agregar.pedido');

// Ruta para pagar todo el pedido
Route::post('/pagar-todo', [PedidoController::class, 'pagarTodo'])->name('pagar.todo');

// Ruta para pagar por separado
Route::post('/pagar-separado', [PedidoController::class, 'pagarSeparado'])->name('pagar.separado');

// Ruta para ver el pedido actual
Route::get('/pedidos', [PedidoController::class, 'verPedido'])->name('ver.pedido');

// Ruta para eliminar un producto del pedido
Route::delete('/eliminar-pedido', [PedidoController::class, 'eliminarProducto'])->name('eliminar.pedido');

//Ruta para mostrar el formulario de hacer pedido
Route::post('/hacer-pedido', [PedidoController::class, 'hacerPedido'])->name('hacer.pedido');