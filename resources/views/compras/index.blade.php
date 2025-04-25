@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Card para el botón Agregar compras -->
    <div class="card cardModulo">
        <div class="encabezadoModulo">
            <h2 class="mb-0">Historial de Compras</h2>
            <a href="{{ route('compras.create') }}" class="btn botonNuevo">
                <i class="bi bi-plus-circle"></i> Registrar Compra
            </a>
        </div>
    </div>

    <!-- Card para la tabla de categorías -->
    <div class="card">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <table class="tablaPersonalizada">
                <thead>
                    <tr>
                        <th>N°</th>
                        
                        <th>Fecha <br> de ingreso</th>
                        <th>Usuario</th>
                        <th>Proveedor</th>                        
                        <th>Total <br> compra</th>
                        <th>Monto <br> pagado</th>                        
                        <th>Estado</th>
                        <th>Forma <br> de pago</th>
                        
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compras as $compras)
                    <tr>
                        <td>{{ $compras->id }}</td>                        
                        <td>{{ $compras->fechaingreso }}</td>
                        <td>{{ $compras->usuario->name ?? 'Sin usuario' }}</td>
                        <td>{{ $compras->proveedor->nombre ?? 'Sin proveedor' }}</td>
                        <td>{{ $compras->total_compra }}</td>
                        <td>{{ $compras->monto_pagado }}</td>
                        <td>{{ $compras->estado == '1' ? 'Pagado ' : 'Pendiente' }}</td>
                        <td>{{ $compras->forma_pago }}</td>
                        <td class="acciones">
                            <a href="#" class="btn botonAcciones boton1">
                                <i class="bi bi-coin"></i> Pagar
                            </a>
                            <a href="#" class="btn botonAcciones boton1">
                                <i class="bi bi-list-columns"></i> Ver detalle
                            </a>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
