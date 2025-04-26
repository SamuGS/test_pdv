<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver roles')->only('index');
        $this->middleware('permission:Crear roles')->only(['create', 'store']);
        $this->middleware('permission:Editar roles')->only('updatePermissions');
        $this->middleware('permission:Eliminar roles')->only('toggleEstado');
    }
    
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

    public function getPermissionsByRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all()->map(function ($permission) use ($role) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'assigned' => $role->hasPermissionTo($permission->name),
            ];
        });

        return response()->json(['permissions' => $permissions]);
    }

    public function updatePermissions(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }

    public function toggleEstado(Role $role)
    {
        $role->estado = !$role->estado;
        $role->save();

        return redirect()->back()->with('success', 'Estado del rol actualizado correctamente.');
    }
}