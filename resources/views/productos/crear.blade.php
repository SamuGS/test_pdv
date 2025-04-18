@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Crear Nuevo Producto</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="proveedor_id">Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="imagen">Imagen del Producto</label>
                    <input type="file" name="imagen" id="imagen" class="form-control-file">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Guardar Producto</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
