<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Abono;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver ventas')->only(['index', 'show']);
        $this->middleware('permission:Crear ventas')->only(['create', 'store']);
        $this->middleware('permission:Editar ventas')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar ventas')->only(['destroy', 'desactivando']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas con sus relaciones
        $ventas = Venta::with('clientes')->paginate(5);
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar vista de creación de venta
        $clientes = Clientes::all();
        $productos = Producto::all();
        return view('ventas.crear', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aquí puedes guardar la venta si es necesario
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar detalles de la venta especificada
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Editar una venta existente
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Actualizar venta
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar venta
    }

    // Método para mostrar el catálogo de productos
    public function catalogo(Request $request)
    {
        $clienteId = $request->cliente_id;
        $cliente = Clientes::findOrFail($clienteId);

        // Guardar el cliente_id en la sesión
        session(['cliente_id' => $clienteId]);

        $categorias = Categoria::with('productos')->get(); // Agrupados por categoría
        $productos = Producto::with('categoria')->take(10)->get(); // Todos (máximo 10)

        return view('ventas.catalogo', compact('cliente', 'categorias', 'productos'));
    }

    // Mostrar resumen de la venta
    public function mostrarResumen()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'];
        }

        return view('ventas.resumen', compact('carrito', 'total'));
    }

    // Método para ir a la pantalla de pago (tipo de venta y método de pago)
    public function seleccionarPago()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'];
        }

        // Verificar si el carrito está vacío
        if (empty($carrito)) {
            return redirect()->route('ventas.catalogo')->with('error', 'El carrito está vacío.');
        }

        return view('ventas.tipo', compact('total'));
    }

    // Método para procesar la venta (finalizar venta)
    public function finalizarVenta(Request $request)
    {
        $request->validate([
            'tipo_venta' => 'required|in:total,parcial',
            'abono' => 'nullable|numeric|min:0',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia'
        ]);

        $carrito = session()->get('carrito', []);
        $clienteId = session('cliente_id');
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'];
        }

        // Validación si no hay productos
        if (empty($carrito)) {
            return redirect()->route('ventas.catalogo')->with('error', 'No hay productos en la venta.');
        }

        // Procesar el pago (total o parcial)
        $esPagoTotal = $request->tipo_venta === 'total';
        $abono = $esPagoTotal ? $total : ($request->abono ?? 0);
        $pendiente = $total - $abono;
        $metodoPago = $request->input('metodo_pago');

        // Registrar la venta
        $nuevaVenta = Venta::create([
            'cliente_id' => $clienteId,
            'total' => $total,
            'correlativo' => 'V-' . now()->format('YmdHis'),
            'tipo_pago' => $request->tipo_venta,
            'monto_pagado' => $abono,
            'saldo_pendiente' => $pendiente,
            'estado' => $esPagoTotal ? 1 : 0,
            'metodo_pago' => $metodoPago,
        ]);

        // Registrar los productos en la venta
        foreach ($carrito as $item) {
            DetalleVenta::create([
                'venta_id' => $nuevaVenta->id,
                'producto_id' => $item['id'],
                'cantidad' => 1, // Ajustar si necesitas manejar cantidades
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Si hay abono parcial, registrarlo
        if (!$esPagoTotal && $abono > 0) {
            Abono::create([
                'venta_id' => $nuevaVenta->id,
                'monto' => $abono,
                'fecha' => now()
            ]);
        }

        // Limpiar el carrito y los datos de la sesión
        session()->forget(['carrito', 'cliente_id']);

        // Redirigir al listado de ventas con mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente');
    }

    // Método para filtrar productos por categoría
    public function filtrarPorCategoria($categoriaId = null)
    {
        if ($categoriaId && $categoriaId !== 'todos') {
            $productos = Producto::where('categoria_id', $categoriaId)->get();
        } else {
            $productos = Producto::latest()->take(10)->get(); // Si no hay categoría o se selecciona "todos"
        }

        return response()->json(['productos' => $productos]);
    }

    // Método para agregar productos al carrito
    public function agregarAlCarrito(Request $request, $productoId)
    {
        $producto = Producto::find($productoId);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $carrito = session()->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        $existe = false;
        foreach ($carrito as $item) {
            if ($item['id'] == $producto->id) {
                $existe = true;
                break;
            }
        }

        // Si el producto no está en el carrito, agregarlo
        if (!$existe) {
            $carrito[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
            ];
            session()->put('carrito', $carrito);
        }

        return response()->json($carrito);
    }

    // Método para ver el carrito
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        return response()->json($carrito);
    }

    // Método para eliminar productos del carrito
    public function eliminarDelCarrito($productoId)
    {
        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            if ($item['id'] == $productoId) {
                unset($carrito[$key]);
                break;
            }
        }

        session()->put('carrito', $carrito);

        return response()->json($carrito);
    }
}
