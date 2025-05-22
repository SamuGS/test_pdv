@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Card para el botón Agregar Categoria -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Respaldo y Recuperación de información</h2>
            @can('Crear categorias')
            
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- Generación de respaldo -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header card-header-custom">
                        <h2 class="mb-0">Generación de respaldo</h2>
                    </div>
                    <div class="card-body">                        
                        <h4>Presiona el botón para generar un respaldo completo del sistema, esto incluye la base de datos e imágenes.</h4>                                            
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('backup.crear') }}" method="POST" target="_blank">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Generar y descargar respaldo
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Instrucciones para restaurar -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header card-header-custom">
                        <h2 class="mb-0">¿Cómo restaurar un respaldo?</h2>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>- Descomprime el archivo <strong>.zip</strong> del respaldo.</li>
                            <li>- Importa el archivo <code>.sql</code> a tu base de datos (por ejemplo, usando phpMyAdmin o línea de comandos).</li>
                            <li>- Para recuperar las imagenes del respaldo y que estas se vean dentro del sistema 
                                    reemplaza los archivos en <code>storage/app/public/imágenes_productos</code> con los que vienen en el respaldo si necesitas restaurar imágenes u otros archivos.</li>
                            <li>- El sistema debería estar restaurado a ese punto en el tiempo.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection