<!-- filepath: c:\xampp\htdocs\prueba1\resources\views\usuarios\editar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Datos del usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulario de Actualización -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <!-- Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <!-- Botones -->
                        <div class="text-center">
                            <!-- Formulario de Actualización -->
                            <form action="{{ route('users.update', $user->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                            </form>

                            <!-- Formulario de Eliminación -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>