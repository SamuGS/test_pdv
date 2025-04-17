@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title">Bienvenido, {{ Auth::user()->name }} 👋</h4>
                <p class="card-text">Te has autenticado correctamente en el sistema.</p>
            </div>
        </div>

        {{-- Puedes agregar tarjetas resumen aquí si lo deseas --}}
        {{-- Ejemplo: --}}
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios registrados</h5>
                        <p class="card-text display-6">{{ $usuarios ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Categorías registradas</h5>
                        <p class="card-text display-6">{{ $categorias ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
