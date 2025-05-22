@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seleccionar Tipo de Venta</h2>

    <p class="mb-3">Total de la venta: <strong>${{ number_format($total, 2) }}</strong></p>

    <form action="{{ route('ventas.procesar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tipo_venta">Tipo de Venta</label>
            <select name="tipo_venta" id="tipo_venta" class="form-control" required>
                <option value="">Seleccione una opción</option>
                <option value="total">Venta Total</option>
                <option value="parcial">Venta Parcial (Abonos)</option>
            </select>
        </div>

        <div id="abono-container" class="form-group mt-3" style="display: none;">
            <label for="abono">Monto del primer abono</label>
            <input type="number" name="abono" class="form-control" placeholder="Ingrese abono">
        </div>

        <div>
        <label>Método de pago</label>
        <select name="metodo_pago" class="form-control" required>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="transferencia">Transferencia</option>
        </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Finalizar Venta</button>
    </form>
</div>

<script>
    document.getElementById('tipo_venta').addEventListener('change', function() {
        const abonoContainer = document.getElementById('abono-container');
        abonoContainer.style.display = this.value === 'parcial' ? 'block' : 'none';
    });
</script>
@endsection