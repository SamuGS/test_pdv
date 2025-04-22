@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar Categoría</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Crear -->
            <form action="{{ route('categorias.store') }}" method="POST" id="form-create">

                @csrf

                <!-- Nombre con icono -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-tag-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre de la categoría">
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-main" id="btn-create">Crear categoría</button>

                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary-custom">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
