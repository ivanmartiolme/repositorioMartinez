@extends('layouts.app')

@section('content')
<div class="container py-8">
    <!-- Encabezado con gradiente -->
    <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-xl shadow-xl p-6 mb-8 text-white">
        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-center">Nuestra Carta</h1>
        <p class="text-lg opacity-90 text-center">Descubre nuestras deliciosas opciones</p>
        
        <div class="flex justify-center mt-6">
            <a href="{{ route('mostrar.mesas') }}" class="bg-white text-green-600 hover:bg-green-50 font-medium px-6 py-3 rounded-lg shadow-md transition-all duration-300 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" />
                </svg>
                <span>Seleccionar Mesa</span>
            </a>
        </div>
    </div>

    <!-- Mensajes de error y éxito -->
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-md shadow-md animate__animated animate__fadeIn" role="alert">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    @if(session('mensaje'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-md shadow-md animate__animated animate__fadeIn" role="alert">
            <p class="font-medium">{{ session('mensaje') }}</p>
        </div>
    @endif

    <!-- Menú dividido en columnas -->
    @if($paginaActual == 1)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Primera columna: Desayunos y Postres -->
            <div>
                <!-- Desayunos -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                        <span class="text-xl mr-2">☕</span>
                        <h3 class="text-lg font-semibold text-gray-800">Desayunos</h3>
                    </div>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="divide-y divide-gray-200">
                            @foreach($menuPaginado['desayunos_postres']->where('categoria', 'desayunos') as $item)
                                <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                    <div>
                                        <span class="text-gray-800">{{ $item->nombre }}</span>
                                        <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                    </div>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>

                <!-- Postres -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                        <span class="text-xl mr-2">🍰</span>
                        <h3 class="text-lg font-semibold text-gray-800">Postres</h3>
                    </div>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="divide-y divide-gray-200">
                            @foreach($menuPaginado['desayunos_postres']->where('categoria', 'postres') as $item)
                                <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                    <div>
                                        <span class="text-gray-800">{{ $item->nombre }}</span>
                                        <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                    </div>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Segunda columna: Bocadillos -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                        <span class="text-xl mr-2">🥪</span>
                        <h3 class="text-lg font-semibold text-gray-800">Bocadillos</h3>
                    </div>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="divide-y divide-gray-200">
                            @foreach($menuPaginado['bocadillos'] as $item)
                                <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                    <div>
                                        <span class="text-gray-800">{{ $item->nombre }}</span>
                                        <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                    </div>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Tercera columna: Sándwiches -->
            <div>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                        <span class="text-xl mr-2">🥪</span>
                        <h3 class="text-lg font-semibold text-gray-800">Sándwiches</h3>
                    </div>
                    <form action="{{ route('agregar.pedido') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mesa_id" value="1">
                        <ul class="divide-y divide-gray-200">
                            @foreach($menuPaginado['sandwiches'] as $item)
                                <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                    <div>
                                        <span class="text-gray-800">{{ $item->nombre }}</span>
                                        <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                    </div>
                                    <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    @elseif($paginaActual == 2)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Hamburguesas -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                    <span class="text-xl mr-2">🍔</span>
                    <h3 class="text-lg font-semibold text-gray-800">Hamburguesas</h3>
                </div>
                <form action="{{ route('agregar.pedido') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mesa_id" value="1">
                    <ul class="divide-y divide-gray-200">
                        @foreach($menuPaginado['hamburguesas'] as $item)
                            <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                <div>
                                    <span class="text-gray-800">{{ $item->nombre }}</span>
                                    <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                </div>
                                <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>

            <!-- Bebidas -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex items-center">
                    <span class="text-xl mr-2">🥤</span>
                    <h3 class="text-lg font-semibold text-gray-800">Bebidas</h3>
                </div>
                <form action="{{ route('agregar.pedido') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mesa_id" value="1">
                    <ul class="divide-y divide-gray-200">
                        @foreach($menuPaginado['bebidas'] as $item)
                            <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50">
                                <div>
                                    <span class="text-gray-800">{{ $item->nombre }}</span>
                                    <span class="font-semibold text-gray-900 ml-2">{{ number_format($item->precio, 2) }}€</span>
                                </div>
                                <button type="submit" name="pedido" value="{{ $item->id }}" class="text-green-600 hover:text-white bg-white hover:bg-green-600 border border-green-600 rounded-full p-1 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
    @endif

    <!-- Navegación y Ver Pedido -->
    <div class="mt-8 flex flex-col md:flex-row justify-between items-center">
        <div class="flex space-x-4 mb-4 md:mb-0">
            @if($paginaActual > 1)
                <a href="{{ route('menu', ['page' => $paginaActual - 1]) }}" class="bg-white text-gray-700 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg shadow-sm transition-colors duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Anterior
                </a>
            @else
                <button disabled class="bg-gray-100 text-gray-400 font-medium px-4 py-2 rounded-lg shadow-sm flex items-center cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Anterior
                </button>
            @endif

            <span class="bg-white px-4 py-2 rounded-lg shadow-sm text-gray-600 text-sm">
                Página {{ $paginaActual }} de {{ $totalPaginas }}
            </span>

            @if($paginaActual < $totalPaginas)
                <a href="{{ route('menu', ['page' => $paginaActual + 1]) }}" class="bg-white text-gray-700 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg shadow-sm transition-colors duration-300 flex items-center">
                    Siguiente
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <button disabled class="bg-gray-100 text-gray-400 font-medium px-4 py-2 rounded-lg shadow-sm flex items-center cursor-not-allowed">
                    Siguiente
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>

        <a href="{{ route('ver.pedido') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-colors duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            Ver mi Pedido
        </a>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradientAnimation 5s ease infinite;
    }
    
    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
</style>
@endpush
