@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Categorías a la izquierda --}}
        <div class="col-md-2 border-end">
            <h5 class="mt-3">Categorías</h5>
            <ul class="list-group">
                <li class="list-group-item active categoria-item" data-id="todos">Todos</li>
                @foreach($categorias as $categoria)
                    <li class="list-group-item categoria-item" data-id="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Productos en el centro --}}
        <div class="col-md-7">
            <div class="row" id="contenedor-productos">
                @foreach($productos as $producto)
                    <div class="col-md-4 mb-4 producto-card" data-categoria="{{ $categorias->first()->id }}">
                        <div class="card h-100">
                            @if ($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" style="height:150px; object-fit:cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">{{ Str::limit($producto->descripcion, 60) }}</p>
                                <p class="text-muted">${{ number_format($producto->precio, 2) }}</p>
                                <button class="btn btn-primary btn-sm agregar-producto" data-id="{{ $producto->id }}"
                                    data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Carrito a la derecha --}}
        <div class="col-md-3 border-start">
            <h5 class="mt-3">Carrito</h5>
            <ul class="list-group mb-2" id="vista-previa-carrito"></ul>
            <p><strong>Total:</strong> <span id="total-carrito">$0.00</span></p>
            <a href="{{ route('ventas.resumen') }}" class="btn btn-success w-100">Continuar</a>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
// Obtener token CSRF desde meta
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Función para agregar producto al carrito
function agregarProductoAlCarrito(producto) {
    fetch(`/ventas/agregar-al-carrito/${producto.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({}) // puedes agregar más datos si necesitas
    })
    .then(res => res.json())
    .then(carrito => {
        actualizarVistaCarrito(carrito);
    })
    .catch(error => console.error('Error al agregar producto al carrito:', error));
}

// Agregar evento a los botones iniciales
document.querySelectorAll('.agregar-producto').forEach(btn => {
    btn.addEventListener('click', function () {
        const producto = {
            id: this.dataset.id,
            nombre: this.dataset.nombre,
            precio: parseFloat(this.dataset.precio)
        };
        agregarProductoAlCarrito(producto);
    });
});

// Quitar producto del carrito
function quitarDelCarrito(productoId) {
    fetch(`/ventas/eliminar-del-carrito/${productoId}`)
        .then(res => res.json())
        .then(carrito => {
            actualizarVistaCarrito(carrito);
        })
        .catch(error => console.error('Error al quitar producto del carrito:', error));
}

// Actualizar vista del carrito
function actualizarVistaCarrito(carrito) {
    const contenedor = document.getElementById('vista-previa-carrito');
    const total = document.getElementById('total-carrito');
    contenedor.innerHTML = '';
    let suma = 0;

    carrito.forEach(item => {
        suma += item.precio * (item.cantidad ?? 1);
        contenedor.innerHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>${item.nombre}<br><small class="text-muted">$${item.precio.toFixed(2)}</small></div>
                <button class="btn btn-sm btn-outline-danger quitar-producto" data-id="${item.id}">&times;</button>
            </li>
        `;
    });

    total.textContent = `$${suma.toFixed(2)}`;

    document.querySelectorAll('.quitar-producto').forEach(btn => {
        btn.addEventListener('click', function () {
            quitarDelCarrito(this.dataset.id);
        });
    });
}

// Filtro por categorías
document.querySelectorAll('.categoria-item').forEach(item => {
    item.addEventListener('click', function () {
        const categoriaId = this.dataset.id;

        document.querySelectorAll('.categoria-item').forEach(el => el.classList.remove('active'));
        this.classList.add('active');

        fetch(`/ventas/filtrar-productos/${categoriaId}`)
            .then(res => res.json())
            .then(data => {
                const contenedor = document.getElementById('contenedor-productos');
                contenedor.innerHTML = '';

                data.productos.forEach(producto => {
                    contenedor.innerHTML += `
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                ${producto.imagen ? `<img src="/storage/${producto.imagen}" class="card-img-top" style="height:150px; object-fit:cover;">` : ''}
                                <div class="card-body">
                                    <h5 class="card-title">${producto.nombre}</h5>
                                    <p class="card-text">${producto.descripcion.substring(0, 60)}</p>
                                    <p class="text-muted">$${parseFloat(producto.precio).toFixed(2)}</p>
                                    <button class="btn btn-primary btn-sm agregar-producto" 
                                            data-id="${producto.id}" 
                                            data-nombre="${producto.nombre}" 
                                            data-precio="${producto.precio}">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });

                // Reasignar eventos a los botones "Agregar" recargados
                document.querySelectorAll('.agregar-producto').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const producto = {
                            id: this.dataset.id,
                            nombre: this.dataset.nombre,
                            precio: parseFloat(this.dataset.precio)
                        };
                        agregarProductoAlCarrito(producto);
                    });
                });
            })
            .catch(error => {
                console.error('Error al obtener los productos:', error);
            });
    });
});
</script>
@endsection
