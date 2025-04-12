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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
