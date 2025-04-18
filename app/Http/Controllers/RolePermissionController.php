<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();

        return view('roles.index', compact('roles', 'users'));
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
}