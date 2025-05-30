@extends('layouts.app')

@section('content')
<div class="container py-8">
    <!-- Encabezado con gradiente -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl shadow-xl p-6 mb-8 text-white">
        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-center">Seleccionar Mesa</h1>
        <p class="text-lg opacity-90 text-center">Por favor, selecciona una mesa para continuar con tu pedido.</p>
    </div>

    <!-- Advertencia si ya hay mesa activa -->
    @if(session()->has('mesa_id'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8 rounded-md shadow-md" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <strong>Atención:</strong> Ya tienes seleccionada la mesa <strong>{{ session('mesa_id') }}</strong>. 
                        No puedes seleccionar otra hasta que completes el pedido.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Listado de mesas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($mesas as $mesa)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <div class="flex items-center justify-center w-16 h-16 {{ $mesa->estado === 'Disponible' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} rounded-full mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center text-gray-800 mb-2">{{ $mesa->nombre }}</h3>
                    <div class="flex justify-center mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $mesa->estado === 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $mesa->estado }}
                        </span>
                    </div>

                    @if ($mesa->estado === 'Disponible')
                        <form action="{{ route('seleccionar.mesa') }}" method="POST" class="text-center">
                            @csrf
                            <input type="hidden" name="mesa_id" value="{{ $mesa->id }}">
                            <button type="submit" 
                                class="w-full py-3 px-4 {{ session()->has('mesa_id') ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-white border border-indigo-500 text-indigo-600 hover:bg-indigo-500 hover:text-white' }} rounded-lg transition-colors duration-300"
                                {{ session()->has('mesa_id') ? 'disabled' : '' }}>
                                Seleccionar
                            </button>
                        </form>
                    @else
                        <button class="w-full py-3 px-4 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed" disabled>
                            Ocupada
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Botón para volver al menú -->
    <div class="mt-8 text-center">
        <a href="{{ route('menu') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver al Menú
        </a>
    </div>
</div>
@endsection

@push('styles')
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
