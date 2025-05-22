@extends('layouts.app')

@section('page_css')
<style>
    .custom-file-input {
        display: none;
    }

    .custom-file-label {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 25px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .custom-file-label:hover {
        background-color: #e0e0e0;
        border-color: #999;
    }

    .custom-file-label::before {
        content: "\f016";
        /* FontAwesome icon for folder */
        font-family: 'Font Awesome 5 Free';
        margin-right: 5px;

    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Editar Datos del Producto</h2>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <!-- Formulario de Actualización -->
            <form action="{{ route('productos.update', $producto->id) }}"
                method="POST"
                id="form-edit"
                enctype="multipart/form-data">

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
                            value="{{ $producto->nombre }}"
                            required>
                    </div>
                </div>

                <!-- Descripción con icono -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-body-text"></i>
                        </span>
                        <input type="text"
                            class="form-control border-start-0 rounded-end-pill"
                            id="descripcion"
                            name="descripcion"
                            value="{{ $producto->descripcion }}"
                            required>
                    </div>
                </div>

                <!-- Precio con icono -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-tags-fill"></i>
                        </span>
                        <input type="text"
                            class="form-control border-start-0 rounded-end-pill"
                            id="precio"
                            name="precio"
                            value="{{ $producto->precio }}"
                            required>
                    </div>
                </div>

                <!-- Categoría -->
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-tag-fill"></i>
                        </span>
                        <select class="form-control" id="categoria_id" name="categoria_id" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Proveedor</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-tag-fill"></i>
                        </span>
                        <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Unidades Medida -->
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Unidad Medida</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-tag-fill"></i>
                        </span>
                        <select class="form-control" id="unidad_medida_id" name="unidad_medida_id">
                            <option value="">Seleccione una unidad de medida</option>
                            @foreach ($unidadesMedida as $unidad)
                            <option value="{{ $unidad->id }}" {{ $producto->unidad_medida_id == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->nombre }} ({{ $unidad->abreviatura }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <!-- Input para subir nueva imagen -->
                    <div class="input-group mt-3">
                        <span class="input-group-text">
                            <i class="bi bi-upload"></i>
                        </span>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="row"><br>
                        <!-- Imagen actual -->
                        <div class="col-md-6 d-flex flex-column align-items-center"><br>
                            <span class="mb-2 fw-bold">Imagen actual</span>
                            @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="height: 150px;">
                            @else
                            <p class="text-muted">Sin imagen</p>
                            @endif
                        </div>

                        <!-- Vista previa nueva imagen -->
                        <div class="col-md-6 d-flex flex-column align-items-center"><br>
                            <span class="mb-2 fw-bold">Nueva imagen</span>
                            <img id="imagePreview" class="img-thumbnail" style="height: 150px; display: none;">
                        </div>
                    </div>
                </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between mt-4">
            <button type="button"
                class="btn btn-main"
                id="btn-update">Actualizar</button>

            <a href="{{ route('productos.index') }}"
                class="btn btn-secondary-custom">Cancelar</a>
        </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('page_js')
<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('imagePreview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection