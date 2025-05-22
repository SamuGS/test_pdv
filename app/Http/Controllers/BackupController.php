<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    public function __construct()
    {        
        $this->middleware('permission:Crear respaldo')->only(['crearBackup']);        
    }
    
    public function index(){        
        return view('respaldo.index');
    }

    public function crearBackup(){
        Artisan::call('backup:run');

        $files = Storage::disk('local')->files('Laravel');
        $latest = collect($files)->sortByDesc(fn($file) => Storage::disk('local')->lastModified($file))->first();

        if (!$latest) {
            return back()->with('error', 'No se pudo generar el respaldo.');
        }

        // Guardar copia en otra carpeta antes de descargar
        $nombreArchivo = basename($latest);
        Storage::disk('local')->copy($latest, "respaldos_guardados/{$nombreArchivo}");

        // Descargar al usuario
        return Storage::disk('local')->download($latest, 'respaldo-' . now()->format('Y-m-d_H_i_s') . '.zip');
    }    
}
