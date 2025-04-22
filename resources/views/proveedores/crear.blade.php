@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Agregar Proveedores</h2>
        </div>
        <div class="card-body">
            <!-- Formulario de Crear -->
            <form action="{{ route('proveedores.store') }}" method="POST" id="form-create">

                @csrf

                <!-- Nombre con icono -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-vcard"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="nombre" name="nombre" required placeholder="Nombre del proveedor">
                    </div>
                </div>

                <!-- Dirección  con icono -->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="direccion" name="direccion" required placeholder="Direccion del proveedor">
                    </div>
                </div>

                 <!-- Teléfono con icono -->
                 <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-telephone-inbound-fill"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="telefono" name="telefono" required placeholder="Teléfono del proveedor">
                    </div>
                </div>

                

                 <!-- Correo con icono -->
                 <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-envelope"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" id="email" name="email" required placeholder="Correo electrónico del proveedor">
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary-custom">Cancelar</a>
                    <button type="button" class="btn btn-main" id="btn-create">Crear proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
