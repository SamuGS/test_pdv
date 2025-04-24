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
        content: "\f016"; /* FontAwesome icon for folder */
        font-family: 'Font Awesome 5 Free';
        margin-right: 5px;
    }
</style> 
@endsection

@section('content')
<div class="container">
    <div class="card ">
        <div class="card-header card-header-custom">
            <h4 class="mb-0">Agregar Nuevo Producto</h4>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" id="form-create">
                @csrf

                <div class="mb-3">
                    <label for="nombre">Nombre del Producto</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-boxes"></i></span>
                    <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre del producto">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion">Descripción</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-body-text"></i></span>
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precio">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-tags-fill"></i></span>
                    <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="categoria_id">Categoría</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-tag-fill"></i></span>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="proveedor_id">Proveedor</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-person-fill"></i></span>
                    <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="unidad_medida_id">Unidad de Medida</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-rulers"></i></span>
                        <select name="unidad_medida_id" id="unidad_medida_id" class="form-control">
                            <option value="">Seleccione una unidad de medida</option>
                            @foreach ($unidadesMedida as $unidad)
                                <option value="{{ $unidad->id }}" {{ old('unidad_medida_id') == $unidad->id ? 'selected' : '' }}>
                                    {{ $unidad->nombre }} ({{ $unidad->abreviatura }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="imagen">Imagen del Producto</label>

                    <input type="file" name="imagen" id="imagen" class="form-control-file">

                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-upload"></i></i></span>
                    <input type="file" name="imagen" id="imagen" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                    </div>

                </div>

                <div class="mt-2">
                    <img id="imagePreview" src="#" alt="Miniatura" style="display: none; max-width: 200px;"/>

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

@section('page_js')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }    
</script>
@endsection