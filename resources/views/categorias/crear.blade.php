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
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf                        

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>                                                

<<<<<<< Updated upstream
                        <!-- Botones -->
                        <div class="text-center">                            
                            <!-- Botón de enviar -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
=======
                        
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Botón para Actualizar -->
                            <button type="submit" class="btn btn-success">Crear categoría</button>

                            <!-- Botón Cancelar -->
                            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
>>>>>>> Stashed changes
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
</x-app-layout>
=======
</div>
@endsection
>>>>>>> Stashed changes
