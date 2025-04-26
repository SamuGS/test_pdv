@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Resumen de la Venta</h2>

    @if(count($venta) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta as $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>${{ number_format($item['precio'], 2) }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ number_format($total, 2) }}</h4>

        <div class="mt-4">
            <a href="{{ route('ventas.tipo') }}" class="btn btn-success">Siguiente: Seleccionar Tipo de Venta</a>
        </div>
    @else
        <p>No hay productos en la venta.</p>
    @endif
</div>
@endsection
