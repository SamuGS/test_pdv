@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Card para el botón Agregar Categoria -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Generación de Reportes</h2>            
        </div>
    </div>

    <!-- Card para la tabla de categorías -->
    <div class="card">
        <div class="card-body" style="overflow-y: auto;">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-bg-dark text-center">
                            <b>PRODUCTOS</b>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <a href="{{ route('reportes.repProductos') }}" target="_blank">
                                <button class="btn btn-danger">INVENTARIO EXISTENTE</button>
                            </a>
                        </div>                        
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-bg-dark text-center">
                            <b>PROVEEDORES</b>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <a href="{{ route('reportes.repProveedores') }}" target="_blank">
                                <button class="btn btn-danger">PROVEEDORES EXISTENTES</button>
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-bg-dark text-center">
                            <b>VENTAS</b>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <a href="" target="_blank">
                                <button class="btn btn-danger">VENTAS REALIZADAS</button>
                            </a>
                        </div>                        
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-bg-dark text-center">
                            <b>CLIENTES</b>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <a href="" target="_blank">
                                <button class="btn btn-danger">CLIENTES EXISTENTES</button>
                            </a>
                        </div>                        
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
