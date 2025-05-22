<table class="tablaPersonalizada">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Proveedor</th>
            <th>Estado</th>
            <th class="acciones">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" width="50">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td >{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                <td>{{ $producto->estado == '1' ? 'Activado' : 'Desactivado' }}</td>
                <td class="acciones">
                    @can('Editar productos')
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn botonAcciones boton1"><i class="bi bi-pencil-square"></i>Editar</a>
                    @endcan

                    @can('Eliminar productos')
                    <form action="{{ route('productos.desactivando', $producto->id) }}" method="POST" style="display:inline;" id="form-estado-{{ $producto->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn botonAcciones boton2 {{ $producto->estado == 1 ? 'btn-danger' : 'btn-success' }}" id="btn-estado-{{ $producto->id }}">
                            <i class="bi {{ $producto->estado == 1 ? 'bi-x-circle' : 'bi-check-circle' }}"></i>{{ $producto->estado == 1 ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>