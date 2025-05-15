@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar cliente</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Crear -->
            <form action="{{ route('clientes.store') }}" method="POST" id="form-create">

                @csrf

                <!-- Nombre con icono -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-add"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre del cliente">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-telephone-plus"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill telefono" id="telefono" name="telefono" required placeholder="Teléfono del cliente">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-house-add"></i></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="direccion" name="direccion" required placeholder="Dirección del cliente">
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary-custom">Cancelar</a>
                    <button type="button" class="btn btn-main" id="btn-create">Agregar cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page_js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Inputmask({"mask": "9999-9999"}).mask(document.querySelectorAll(".telefono"));
        });
    </script>    
@endsection