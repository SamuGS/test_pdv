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
        //BUSCANDO CLIENTE
        $clientes = Clientes::findOrFail($id);

        //RETORNANDO LA VISTA DE EDITAR USUARIO
        return view('clientes.editar', compact('clientes'));
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
            'telefono' => 'required|string|max:9',            
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:1', 
            
        ]);

        // Buscar el usuario
        $clientes = Clientes::findOrFail($id);

        // Actualizar los datos del usuario
        $clientes->nombre = $request->nombre;
        $clientes->telefono = $request->telefono; 
        $clientes->direccion = $request->direccion; 
        $clientes->estado = $request->estado;     
        $clientes->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        //
    }
    
    //ACTUALIZANDO ESTADO A 2 = INACTIVO
    public function desactivando(string $id)
{
    // BUSCANDO LA CATEGORIA
    $clientes = Clientes::findOrFail($id);

    // CAMBIANDO EL ESTADO
    $clientes->estado = $clientes->estado == '1' ? '0' : '1';
    $clientes->save();

    // MENSAJE DINÁMICO
    $mensaje = $clientes->estado == '1' ? 'Cliente activado exitosamente.' : 'Cliente desactivado exitosamente.';

    // RETORNANDO A LA VISTA
    return redirect()->route('clientes.index')->with('success', $mensaje);
}
    
}

