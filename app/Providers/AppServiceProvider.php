<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https'); //modifique esto para produccion en railway
        }

        $dirs = [
        'cortes',
        'facturas',
        'imagenes_productos',
        'lotes',
        'ventas',
        ];

        foreach ($dirs as $dir) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // Si también usás respaldos fuera de /public
        if (!Storage::exists('respaldos_guardados')) {
            Storage::makeDirectory('respaldos_guardados');
        }
    }
}
