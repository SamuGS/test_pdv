<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver productos')->only(['index', 'show']);
        $this->middleware('permission:Crear productos')->only(['create', 'store']);
        $this->middleware('permission:Editar productos')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar productos')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos con sus relaciones
        $productos = Producto::with('categoria', 'proveedor')->get();

        // Retornar la vista con los productos
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las categorías y proveedores
        $categorias = Categoria::all();
        $proveedores = Proveedores::all();

        // Retornar la vista de creación con las categorías y proveedores
        return view('productos.crear', compact('categorias', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp,svg|max:5120', // Validación para la imagen
        ]);

        // Manejar la subida de la imagen
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes_productos', 'public'); // Guardar en storage/app/public/imagenes_productos
        }

        // Crear el producto
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
            'estado' => $request->estado,
            'imagen' => $rutaImagen, // Guardar la ruta de la imagen
        ]);

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener el producto por su ID
        $producto = Producto::with('categoria', 'proveedor')->findOrFail($id);

        // Retornar la vista de detalle del producto
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener el producto, categorías y proveedores
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedores::all();

        // Retornar la vista de edición
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|boolean',
        ]);

        // Buscar el producto y actualizarlo
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el producto y eliminarlo
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Redirigir al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
