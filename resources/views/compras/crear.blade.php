@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header card-header-custom">
            <h2 class="mb-0">Registrar compra</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('compras.store') }}" method="POST" id="form-create">
                @csrf

                @php
                use Carbon\Carbon;
                use Illuminate\Support\Facades\Auth;
                date_default_timezone_set('America/El_Salvador');
                $fecha = old('fechaingreso', Carbon::now()->format('Y-m-d\TH:i'));
                $usuario = Auth::user();
                @endphp

                <!-- Fecha y hora -->
                <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha y hora de registro</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-calendar3"></i>
                        </span>
                        <input
                            type="datetime-local"
                            id="fechaingreso"
                            name="fechaingreso"
                            class="form-control border-start-0 rounded-end-pill"
                            required
                            value="{{ $fecha }}">
                    </div>
                </div>

                <!-- Usuario (oculto y nombre) -->
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-person-square"></i>
                        </span>
                        <input type="hidden" name="idusuario" id="idusuario" value="{{ $usuario->id }}">
                        <input
                            type="text"
                            class="form-control border-start-0 rounded-end-pill"
                            value="{{ $usuario->name }}"
                            disabled>
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill">
                            <i class="bi bi-person-vcard"></i>
                        </span>
                        <select
                            name="proveedor_id"
                            id="proveedor_id"
                            class="form-control border-start-0 rounded-end-pill"
                            required>
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                            <option
                                value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('compras.index') }}" class="btn btn-secondary-custom">
                        Cancelar
                    </a>
                    <button type="button" class="btn btn-main" id="btn-create">
                        Registrar compra
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

