<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedores;
use App\Models\Clientes;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Ver categorias')->only(['index', 'show']);
        $this->middleware('permission:Crear categorias')->only(['repProductos', 'repProveedores','repVentasRealizadas','repClientes']);        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    //Para obtener todos los productos.
    public function repProductos()
    {
        $productos = Producto::all();
        $hora_fecha = Carbon::now()->format('d-m-Y_H-i-s');
        $pdf = Pdf::loadView('reportes.inventario', compact('productos'))
                    ->setPaper('letter','landscape');        
        return $pdf->stream('Inventario de productos_'.$hora_fecha.'pdf');
    }

    //Para obtener todos los proveedores.
    public function repProveedores()
    {
        $proveedores = Proveedores::all();
        $hora_fecha = Carbon::now()->format('d-m-Y_H-i-s');
        $pdf = Pdf::loadView('reportes.proveedores', compact('proveedores'))
                    ->setPaper('letter','landscape');        
        return $pdf->stream('Listado de proveedores_'.$hora_fecha.'pdf');
    }

    //Para obtener todas las ventas realizadas.
    public function repVentasRealizadas()
    {
        
    }

    //Para obtener todos los clientes.
    public function repClientes()
    {
        $clientes = Clientes::all();
        $hora_fecha = Carbon::now()->format('d-m-Y_H-i-s');
        $pdf = Pdf::loadView('reportes.clientes', compact('clientes'))
                    ->setPaper('letter','landscape');        
        return $pdf->stream('Listado de clientes_'.$hora_fecha.'pdf');
    }
}
