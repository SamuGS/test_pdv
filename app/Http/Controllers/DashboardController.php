<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $categorias = Categoria::count();

        return view('dashboard', compact('usuarios', 'categorias'));
    }
}
