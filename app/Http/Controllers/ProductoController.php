<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedores;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $productos = Producto::with('categoria', 'proveedor', 'unidadMedida')->paginate(5);
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
        $unidadesMedida = UnidadMedida::all(); // Obtener todas las unidades de medida

        // Retornar la vista de creación con las categorías y proveedores
        return view('productos.crear', compact('categorias', 'proveedores', 'unidadesMedida'));
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
            //'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            //'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Validar la imagen (opcional)
            'unidad_medida_id' => 'nullable|exists:unidades_medida,id', // Validar la unidad de medida
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
            'stock' => '0',
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
            'estado' => '1',
            'imagen' => $rutaImagen, // Guardar la ruta de la imagen
            'unidad_medida_id' => $request->unidad_medida_id, // Guardar la unidad de medida
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
        $unidadesMedida = UnidadMedida::all(); // Obtener todas las unidades de medida

        // Retornar la vista de edición
        return view('productos.editar', compact('producto', 'categorias', 'proveedores', 'unidadesMedida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'unidad_medida_id' => 'nullable|exists:unidades_medida,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Validar la imagen (opcional)
        ]);

        $producto = Producto::findOrFail($id);

        // Manejar la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            // Guardar la nueva imagen
            $rutaImagen = $request->file('imagen')->store('imagenes_productos', 'public');
            $producto->imagen = $rutaImagen;
        }

        // Actualizar los demás campos
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
            'unidad_medida_id' => $request->unidad_medida_id,
        ]);

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

    //ACTUALIZANDO ESTADO A 2 = INACTIVO
    public function desactivando(string $id)
    {
        // BUSCANDO LA CATEGORIA
        $producto = Producto::findOrFail($id);

        // CAMBIANDO EL ESTADO
        $producto->estado = $producto->estado == '1' ? '0' : '1';
        $producto->save();

        // MENSAJE DINÁMICO
        $mensaje = $producto->estado == '1' ? 'Producto activado exitosamente.' : 'Producto desactivado exitosamente.';

        // RETORNANDO A LA VISTA
        return redirect()->route('productos.index')->with('success', $mensaje);
    }
    // BUSCANDO PRODUCTOS
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        $productos = Producto::where('nombre', 'LIKE', "%$query%")
            ->orWhere('descripcion', 'LIKE', "%$query%")
            ->paginate(5);

        // Retorna la vista parcial con los resultados en HTML
    return view('productos.tabla', compact('productos'));
    }
}
