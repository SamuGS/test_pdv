@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header card-header-custom">
      <h2 class="mb-0">Editar Datos del proveedor</h2>
    </div>
    <div class="card-body">
      <!-- Formulario de Actualización -->
      <form action="{{ route('proveedores.update', $proveedores->id) }}"
            method="POST"
            id="form-edit">

        @csrf
        @method('PUT')

        <!-- Nombre con icono -->
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
              <i class="bi bi-tag-fill"></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="nombre"
                   name="nombre"
                   value="{{ $proveedores->nombre }}"
                   required>
          </div>   
        </div>

        <!-- Dirección con icono -->
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-geo-alt-fill"></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="direccion"
                   name="direccion"
                   value="{{ $proveedores->direccion }}"
                   required>
          </div>
        </div>   

        <!-- Teléfono con icono -->
        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-telephone-inbound-fill"></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="telefono"
                   name="telefono"
                   value="{{ $proveedores->telefono }}"
                   required>
          </div>
        </div>      

        <!-- Correo con icono -->
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-envelope"></i>
            </span>


            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="email"
                   name="email"
                   value="{{ $proveedores->email }}"
                   required>
          </div>
        </div>

        <!-- Estado - solo lectura -->
        <div class="mb-3">
          <label for="estado" class="form-label">Estado</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
              <i class="bi bi-toggle-on"></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   value="{{ $proveedores->estado == 1 ? 'Activo' : 'Inactivo' }}"
                   readonly>
            <input type="hidden"
                   name="estado"
                   value="{{ $proveedores->estado }}">
          </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
          <button type="button"
                  class="btn btn-main"
                  id="btn-update">Actualizar</button>

          <a href="{{ route('proveedores.index') }}"
             class="btn btn-secondary-custom">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
