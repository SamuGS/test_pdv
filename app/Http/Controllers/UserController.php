<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Trayendo todos los usuarios
        $users = User::all();
        //Retornando la vista de usuarios
        return view('usuarios.index', compact('users'));       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornando la vista de crear categoria
        return view('usuarios.crear'); //return view('carpeta.nombre_archivo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validando los datos
        $request->validate([
            'nombre' => 'required|string|max:50', // validación para nombre
            'email' => 'required|email|unique:users,email|max:100', // validación para email
            'password' => 'required|string|min:8|confirmed', // validación para contraseña
            'password_confirmation' => 'required|string|min:6', // validación para confirmación de contraseña
            //'rol' => 'required|string|max:50', // Validación para rol
            'estado' => '1', // Validación para estado            
        ]);
        
        // Creando el usuario
        $categoria = User::create([
            'nombre' => $request->nombre,
            'nombre' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
            'estado' => $request->estado,
        ]);        
        
        // Redireccionando a la vista de usuarios
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
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
        //BUSCANDO EL USUARIO
        $user = User::findOrFail($id);

        //RETORNANDO LA VISTA DE EDITAR USUARIO
        return view('usuarios.editar', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'estado' => 'required|boolean', // Validación para estado
            'rol' => 'required|string|max:255', // Validación para rol
        ]);

        // Buscar el usuario
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->estado = $request->estado;
        $user->rol = $request->rol;

        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el usuario por su ID
        $user = User::findOrFail($id);

        // Eliminar el usuario
        $user->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
