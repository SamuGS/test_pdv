<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver usuarios')->only(['index', 'show']);
        $this->middleware('permission:Crear usuarios')->only(['create', 'store']);
        $this->middleware('permission:Editar usuarios')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar usuarios')->only(['destroy', 'desactivando']);
    }
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
        // Obteniendo todos los roles
        $roles = \Spatie\Permission\Models\Role::all();

        // Retornando la vista de crear categoria
        return view('usuarios.crear', compact('roles')); //return view('carpeta.nombre_archivo');
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
            'rol' => 'required|exists:roles,name', // Validación para rol               
        ]);
        
        // Creando el usuario
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password),               
            'estado' => 1, // Guardando el estado         
        ]);     
        
        // Asignando el rol al usuario
        $user->syncRoles($request->rol); // Asignar el rol al usuario
        
        // Redireccionando a la vista de usuarios
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
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

        //OBTENER TODOS LOS ROLES
        $roles = \Spatie\Permission\Models\Role::all();

        //RETORNANDO LA VISTA DE EDITAR USUARIO
        return view('usuarios.editar', compact('user', 'roles'));
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

        $user->save();

        // Actualizar el rol del usuario
        $user->syncRoles($request->rol); // Asignar el rol al usuario

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

    public function desactivando(string $id)
    {
        // Buscar el usuario por su ID
        $user = User::findOrFail($id);

        // Cambiar el estado del usuario
        $user->estado = $user->estado == 1 ? 0 : 1;

        // Guardar el cambio
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado correctamente.');
    }
}
