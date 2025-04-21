@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header card-header-custom">
      <h2 class="mb-0">Editar Datos de la categoría</h2>
    </div>
    <div class="card-body">
      <!-- Formulario de Actualización -->
      <form action="{{ route('categorias.update', $categorias->id) }}"
            method="POST"
            id="form-edit"> <!-- ← Aquí -->

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
                   value="{{ $categorias->nombre }}"
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
                   value="{{ $categorias->estado == 1 ? 'Activo' : 'Inactivo' }}"
                   readonly>
            <input type="hidden"
                   name="estado"
                   value="{{ $categorias->estado }}">
          </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
          <!-- Cambiamos el type a button y le damos un ID -->
          <button type="button"
                  class="btn btn-main"
                  id="btn-update">Actualizar</button>

          <a href="{{ route('categorias.index') }}"
             class="btn btn-secondary-custom">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
