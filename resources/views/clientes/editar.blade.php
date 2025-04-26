@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header card-header-custom">
      <h2 class="mb-0">Editar datos del cliente</h2>
    </div>
    <div class="card-body">
      <!-- Formulario de Actualización -->
      <form action="{{ route('clientes.update', $clientes->id) }}"
            method="POST"
            id="form-edit">

        @csrf
        @method('PUT')

        <!-- Nombre con icono -->
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-person-gear"></i></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="nombre"
                   name="nombre"
                   value="{{ $clientes->nombre }}"
                   required>
          </div>
        </div>
        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-telephone-plus"></i></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="telefono"
                   name="telefono"
                   value="{{ $clientes->telefono }}"
                   required>
          </div>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <div class="input-group">
            <span class="input-group-text rounded-start-pill">
            <i class="bi bi-house-gear"></i></i>
            </span>
            <input type="text"
                   class="form-control border-start-0 rounded-end-pill"
                   id="direccion"
                   name="direccion"
                   value="{{ $clientes->direccion }}"
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
                   value="{{ $clientes->estado == 1 ? 'Activo' : 'Inactivo' }}"
                   readonly>
            <input type="hidden"
                   name="estado"
                   value="{{ $clientes->estado }}">
          </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
          <button type="button"
                  class="btn btn-main"
                  id="btn-update">Actualizar</button>

          <a href="{{ route('clientes.index') }}"
             class="btn btn-secondary-custom">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection