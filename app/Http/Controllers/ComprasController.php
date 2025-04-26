<?php

namespace App\Http\Controllers;

use App\Models\Compras;       // Mantén el modelo con el nombre en plural
use App\Models\Proveedores;   // Mantén el modelo con el nombre en plural
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver compras')->only('index');
        $this->middleware('permission:Crear compras')->only(['create', 'store']);        
    }

    public function index()
    {
        // Trayendo todas las compras
        $compras = Compras::all();

        // Retornando la vista de compras
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        // Trayendo los proveedores
        $proveedores = Proveedores::all();

        // Retornando la vista para crear una nueva compra
        return view('compras.crear', compact('proveedores'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'fechaingreso' => ['required', 'date_format:Y-m-d\TH:i'],
            'idusuario'    => ['required', 'exists:users,id'],
            'proveedor_id' => ['required', 'exists:proveedores,id'],
        ]);

        // Crear la compra y guardar el modelo
        $compra = Compras::create($data);

        // Redirigir a la vista de detalle de compra
        return redirect()->route('detallecompras.crear', ['compra_id' => $compra->id]);

    }


    // Otros métodos (show, edit, update, destroy) según sea necesario
}
