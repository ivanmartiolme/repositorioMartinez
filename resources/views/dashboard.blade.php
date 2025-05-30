@extends('layouts.app')

@section('content')
<div class="container py-8">
    <!-- Encabezado -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-xl p-8 mb-8 text-white">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-lg opacity-90">Selecciona una de las opciones para gestionar tu aplicación de manera eficiente.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-md shadow-md animate__animated animate__fadeIn" role="alert">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(Auth::user()->esAdmin())
            <!-- Productos -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all">
                <div class="p-1 bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 mx-auto bg-blue-100 text-blue-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Ver Productos</h3>
                    <p class="text-gray-600 mb-4">Gestiona los productos disponibles en tu sistema.</p>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-primary">Ir a Productos</a>
                </div>
            </div>

            <!-- Mesas -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all">
                <div class="p-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                <div class="p-6 text-center">
                    <div class="flex justify-center items-center w-16 h-16 mx-auto bg-purple-100 text-purple-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Gestionar Mesas</h3>
                    <p class="text-gray-600 mb-4">Administra las mesas del restaurante.</p>
                    <a href="{{ route('admin.mesas.index') }}" class="btn btn-outline-secondary">Ir a Mesas</a>
                </div>
            </div>
        @endif

        <!-- Menú -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all">
            <div class="p-1 bg-gradient-to-r from-green-500 to-teal-500"></div>
            <div class="p-6 text-center">
                <div class="flex justify-center items-center w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Ver Menú</h3>
                <p class="text-gray-600 mb-4">Consulta el menú disponible para los clientes.</p>
                <a href="{{ route('menu') }}" class="btn btn-outline-success">Ir al Menú</a>
            </div>
        </div>
    </div>

    <!-- Mapa con múltiples ubicaciones -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Ubicaciones del Restaurante</h2>
        <p class="text-gray-600">Consulta nuestras ubicaciones en Tomelloso y Ciudad Real:</p>
        <div id="map" class="rounded-lg shadow-lg mt-4" style="height: 400px; border: 2px solid #0ff;"></div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([39.1, -3.5], 8); // Zoom medio entre Tomelloso y Ciudad Real

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Icono personalizado
        const icono = L.icon({
            iconUrl: '{{ asset("img/pngegg.png") }}',
            iconSize: [50, 50],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50]
        });

        //Tomelloso
        L.marker([39.16436540728475, -3.0071266806453543], { icon: icono }).addTo(map)
            .bindPopup("📍 Tomelloso<br>Av. La Mancha, esquina 150, 13700");

        //Ciudad Real
        L.marker([38.97978039643733, -3.926388730496353], { icon: icono }).addTo(map)
            .bindPopup("📍 Ciudad Real<br>Av. Lagunas de Ruidera, 8, 13004");
    });
</script>
@endpush


