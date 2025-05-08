@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card ">
        <div class="card-header card-header-custom">
            <h3>Seleccionar Cliente</h3>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <form action="{{ route('ventas.catalogo') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="cliente_id">Cliente</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-tag-fill"></i></span>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">-- Seleccione un cliente --</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection