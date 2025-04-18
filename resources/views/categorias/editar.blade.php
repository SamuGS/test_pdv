@extends('layouts.app')
<<<<<<< Updated upstream
=======

@section('content')
>>>>>>> Stashed changes

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Editar Datos de la categoría</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Actualización -->
            <form action="{{ route('categorias.update', $categorias->id) }}" method="POST">
                @csrf
                @method('PUT')

<<<<<<< Updated upstream
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $categorias->nombre }}" required>
=======
                    <form action="{{ route('categorias.update', $categorias->id) }}" method="POST">
                    @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categorias->nombre }}" required>
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" value="{{ $categorias->estado }}" required>
                        </div>

                        <!-- Botones -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
>>>>>>> Stashed changes
                </div>
                <!-- Estado -->
                <div class="mb-3">
                    <label for="name" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ $categorias->estado }}" required>
                </div>


                <!-- Botones Actualizar y Cancelar -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Botón para Actualizar -->
                    <button type="submit" class="btn btn-primary">Actualizar</button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
<<<<<<< Updated upstream
</div>
@endsection
=======
    @endsection
>>>>>>> Stashed changes
