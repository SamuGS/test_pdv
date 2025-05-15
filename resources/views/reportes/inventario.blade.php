<!DOCTYPE html>
<html>
<head>
    <title>Inventario de Productos</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }        
        .encabezado {
            text-align: center;
            margin-bottom: 20px;
        }

        .titulo {
            font-size: 20px;
            font-weight: bold;
            color: #1c2b3a;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
            height: auto;
            border-radius: 10px;
            background-color: #1c2b3a;
            padding: 4px;
            display: inline-block;
        }    

        .tabla-info {
            margin: 0 auto;
            font-size: 12px;
            width: 100%;
            border-collapse: separate; /* para que el border-radius funcione bien */
        }

        .tabla-info td {
            text-align: center;
            background-color: #c30000;
            color: white;
            border-radius: 10px;
            padding: 5px;
        }

        /* 👇 Estilos aplicados solo a la tabla de productos */
        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-productos th,
        .tabla-productos td {
            border: 1px solid #aaa;
            padding: 5px;
            text-align: center;
        }

        .tabla-productos th {
            background-color: #1c2b3a;
            color:white;
        }

        img.producto-img {
            width: 50px;
        }
    </style>

</head>
<body>

    <div class="encabezado">
        <div class="titulo">
            <h3>INVENTARIO DE PRODUCTOS</h3>
        </div>
        <img src="{{ public_path('images/logoPDV.png') }}" alt="Logo" class="logo">
    </div>

    <hr>

    <!-- Información de empresa -->
    <div class="info-empresa">
        <table class="tabla-info">
            <tr>
                <td>
                    <b>Dirección: Calle Ficticia 123, Ciudad Ejemplo</b>
                </td>
                <td>
                    <b>Tel: (000) 123-4567 | Email: empresa@correo.com</b>
                </td>
                <td>
                    <b>Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</b>
                </td>
            </tr>
        </table>                                
    </div>

    <hr>

    <!-- Tabla de productos -->
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>
                        @if ($producto->imagen)
                            <img src="{{ public_path('storage/' . $producto->imagen) }}" alt="Imagen" class="producto-img">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                    <td>{{ $producto->estado == '1' ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No se encontraron productos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
