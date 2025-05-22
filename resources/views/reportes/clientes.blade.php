<!DOCTYPE html>
<html>
<head>
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
            font-size: 13px;
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
            <h3>LISTADO DE PROVEEDORES</h3>
        </div>
        <img src="{{ public_path('images/logoPDV.png') }}" alt="Logo" class="logo">
    </div>

    <hr>

    <!-- Información de empresa -->
    <div class="info-empresa">
        <table class="tabla-info">
            <tr>
                <td style="width: 380px;">
                    <b></i>Dirección:</b> Avenida Las Arboledas, Mercado Municipal de Antiguo Cuscatlan Este, Local #6, Ciudad Merliot.
                </td>
                <td>
                    <b>Contacto:</b> +503 7018-1274 <br> ceciliahernandez1912@outlook.es
                </td>
                <td>
                    <b>Fecha del reporte:</b><br> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
                </td>
            </tr>
        </table>                                
    </div>

    <hr>

    <!-- Tabla de productos -->
    <table class="tabla-productos">
        <thead>
            <tr>                
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>                
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>                    
                    <td>{{ $cliente->nombre }}</td>                    
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>                                    
                    <td>{{ $cliente->estado == '1' ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No se encontraron clientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
