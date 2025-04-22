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
        $roles = Role::all(); // Obtener todos los roles
        $permissions = Permission::all(); // Obtener todos los permisos
        $selectedRole = $request->role_id ? Role::find($request->role_id) : null; // Rol seleccionado

        return view('roles.index', compact('roles', 'permissions', 'selectedRole'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'role' => 'required|string|max:255|unique:roles,name', // El nombre del rol es obligatorio, único y debe ser una cadena
        ]);

        // Crear el rol
        Role::create(['name' => $validated['role']]);

        return redirect()->back()->with('success', 'Rol creado correctamente.');
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