@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div style="text-align: center; padding: 80px;">
    <h1 style="font-size: 72px; color: #e3342f;">Acceso denegado</h1>
    <h2>Lo sentimos, esta sección está reservada solo para administradores.</h2>
    <a href="{{ route('dashboard') }}" style="color: #3490dc;">Volver al panel</a>
</div>
@endsection
