<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
