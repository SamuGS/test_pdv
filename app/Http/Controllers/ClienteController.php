<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Trayendo todos los clientes
         $clientes = Clientes::all();

         //Retornando la vista de clientes
         return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornando la vista de agregar cliente
        return view('clientes.crear'); //return view('carpeta.nombre_archivo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validando los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:9',            
            'direccion' => 'required|string|max:255',            
        ]);
        
        // Agregando cliente
        $clientes = Clientes::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => '1',
        ]);        
        
        // Redireccionando a la vista de clientes
        return redirect()->route('clientes.index')->with('success', '¡Cliente agregado exitosamente!.');
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
