<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver proveedores')->only('index');
        $this->middleware('permission:Crear proveedores')->only(['create', 'store']);
        $this->middleware('permission:Editar proveedores')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar proveedores')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Trayendo todas los proveedores
        $proveedores = Proveedores::all();

        //Retornando la vista de proveedores
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornando la vista de crear proveedores
        return view('proveedores.crear'); //return view('carpeta.nombre_archivo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validando los datos
        $request->validate([
            'nombre' => 'required|string|max:255',  
            'direccion' => 'required|string|max:255',  
            'telefono' => 'required|string|max:9',    
            'email' => 'required|string|max:255',    
        ]);
        
        // Creando Proveedores
        $proveedores = Proveedores::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'estado' => '1',
        ]);        
        
        // Redireccionando a la vista de proveedores
        return redirect()->route('proveedores.index')->with('success', 'Proveedores agregados exitosamente.');
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
         //BUSCANDO EL PROVEEDOR
         $proveedores = Proveedores::findOrFail($id);

         //RETORNANDO LA VISTA DE EDITAR DE PROVEEDOR
         return view('proveedores.editar', compact('proveedores'));
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
            'direccion' => 'required|string|max:255',  
            'telefono' => 'required|string|max:9',    
            'email' => 'required|string|max:255', 
            'estado' => 'required|string|max:1',
            
        ]);

        // Buscar el usuario
        $proveedores = Proveedores::findOrFail($id);

        // Actualizar los datos del usuario
        $proveedores->nombre = $request->nombre; 
        $proveedores->direccion = $request->direccion; 
        $proveedores->telefono= $request->telefono; 
        $proveedores->email = $request->email; 
        $proveedores->estado = $request->estado;     

        $proveedores->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function desactivando(string $id)
{
    // BUSCANDO LA CATEGORIA
    $proveedores = Proveedores::findOrFail($id);

    // CAMBIANDO EL ESTADO
    $proveedores->estado = $proveedores->estado == '1' ? '0' : '1';
    $proveedores->save();

    // MENSAJE DINÁMICO
    $mensaje = $proveedores->estado == '1' ? 'Proveedor activado exitosamente.' : 'Proveedor desactivado exitosamente.';

    // RETORNANDO A LA VISTA
    return redirect()->route('proveedores.index')->with('success', $mensaje);
}
}
