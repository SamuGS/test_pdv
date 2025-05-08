<table class="tablaPersonalizada">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Correlativo Venta</th>
            <th>Total Venta</th>
            <th>Tipo Pago</th>
            <th>Monto Pagado</th>
            <th>Monto Pendiente</th>
            <th>Estado</th>
            <th class="acciones">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ventas as $venta)
        <tr>
            <td>{{ $venta->clientes->nombre ?? 'Sin nombre' }}</td> <!-- Cliente -->
            <td>{{ $venta->correlativo }}</td> <!-- Correlativo Venta -->
            <td>{{ number_format($venta->total, 2) }}</td> <!-- Total Venta -->
            <td>{{ ucfirst($venta->tipo_pago) }}</td> <!-- Tipo Pago -->
            <td>{{ number_format($venta->monto_pagado, 2) }}</td> <!-- Monto Pagado -->
            <td>{{ number_format($venta->saldo_pendiente, 2) }}</td> <!-- Monto Pendiente -->
            <td>
                @if ($venta->estado == 1)
                <span class="badge bg-success">Pagado</span>
                @else
                <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </td> <!-- Estado -->
            <td class="acciones">
                <a href="{{ route('ventas.edit', $venta->id) }}" class="btn botonAcciones boton1"><i class="bi bi-pencil-square"></i>Ver Detalle</a>

                @if ($venta->estado == 0)
                <a href="{{ route('ventas.abono', $venta->id) }}" class="btn botonAcciones btn-secondary">
                    <i class="bi bi-cash-coin"></i> Abonar
                </a>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">No se encontraron resultados.</td>
        </tr>
        @endforelse
    </tbody>
</table>