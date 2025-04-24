<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el texto de búsqueda
        $search = $request->input('search');

        // Filtrar roles si se ingresó un texto de búsqueda
        $roles = Role::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // Si se envía la variable 'search', devolver siempre un JSON
        if ($search) {
            return response()->json(['roles' => $roles]);
        }

        // Obtener todos los permisos
        $permissions = Permission::all();

        // Rol seleccionado (si aplica)
        $selectedRole = $request->role_id ? Role::find($request->role_id) : null;

        return view('roles.index', compact('roles', 'permissions', 'selectedRole'));
    }

    public function getRoles(Request $request)        
    {
        $query = $request->input('search');

        // Filtrar roles si hay un término de búsqueda
        if ($query) {
            $roles = Role::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $roles = Role::all();
        }

        return response()->json(['roles' => $roles]);
    }

    public function getPermissions(Request $request)
    {
        // Verificar si se envió un role_id
        $roleId = $request->input('role_id');
        $role = Role::find($roleId);

        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }

        // Obtener los permisos del rol
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return response()->json([
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function create()
    {
        $permisos = Permission::all(); // Obtener todos los permisos
        return view('roles.crear', compact('permisos')); // Pasar los permisos a la vista        
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,name', // Validar el nombre del rol
            'permisos' => 'nullable|array', // Los permisos son opcionales
            'permisos.*' => 'exists:permissions,name', // Validar que los permisos existan por nombre
        ]);

        // Crear el rol
        $rol = Role::create(['name' => $validated['nombre']]);

        // Asignar permisos al rol (si se seleccionaron)
        if ($request->has('permisos')) {
            $rol->syncPermissions($validated['permisos']);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function assignRoleToUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    public function assignPermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permissions); // Asignar permisos al rol

        return redirect()->back()->with('success', 'Permisos asignados correctamente al rol.');
    }

    public function updatePermissions(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permissions); // Actualizar permisos del rol

        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }
}