<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                    
                    
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>    
                                <th>ID</th>                            
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>                                    
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->estado }}</td>                                    
                                    <td>
                                        <!-- Aquí puedes agregar botones de acción como editar o eliminar -->
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('categorias.create') }}" class="btn btn-success">Agregar Categoria</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>