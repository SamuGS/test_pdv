<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{   
    public function __construct()
    {
        $this->middleware('permission:Ver categorias')->only(['index', 'show']);
        $this->middleware('permission:Crear categorias')->only(['create', 'store']);
        $this->middleware('permission:Editar categorias')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar categorias')->only(['destroy', 'desactivando']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trayendo todas las categorias
        $categorias = Categoria::all();

        //Retornando la vista de categorias
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornando la vista de crear categoria
        return view('categorias.crear'); //return view('carpeta.nombre_archivo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validando los datos
        $request->validate([
            'nombre' => 'required|string|max:255',            
        ]);
        
        // Creando la categoria
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'estado' => '1',
        ]);        
        
        // Redireccionando a la vista de categorias
        return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {        
        //BUSCANDO LA CATEGORIA
        $categorias = Categoria::findOrFail($id);

        //RETORNANDO LA VISTA DE EDITAR USUARIO
        return view('categorias.editar', compact('categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:1',
            
        ]);

        // Buscar el usuario
        $categoria = Categoria::findOrFail($id);

        // Actualizar los datos del usuario
        $categoria->nombre = $request->nombre; 
        $categoria->estado = $request->estado;     

        $categoria->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //ACTUALIZANDO ESTADO A 2 = INACTIVO
    public function desactivando(string $id)
{
    // BUSCANDO LA CATEGORIA
    $categoria = Categoria::findOrFail($id);

    // CAMBIANDO EL ESTADO
    $categoria->estado = $categoria->estado == '1' ? '0' : '1';
    $categoria->save();

    // MENSAJE DINÁMICO
    $mensaje = $categoria->estado == '1' ? 'Categoría activada exitosamente.' : 'Categoría desactivada exitosamente.';

    // RETORNANDO A LA VISTA
    return redirect()->route('categorias.index')->with('success', $mensaje);
}

}
