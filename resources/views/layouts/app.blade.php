<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite('resources/css/global.css')


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<<<<<<< Updated upstream
=======

    <style>
        /* Sidebar scrollable */
        aside {
            height: 100vh;
            /* Full viewport height */
            overflow-y: auto;
            /* Enable vertical scroll if content overflows */
        }
    </style>
>>>>>>> Stashed changes
</head>

<body class="bg-light">
    <div class="d-flex">
        {{-- Sidebar --}}
        <aside class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <!-- Logo de la empresa en lugar de texto -->
            <div class="mb-4">
                <img src="{{ asset('images/logo_don_valentin.jpeg') }}" alt="Logo de la Empresa" class="img-fluid rounded-circle" style="max-width: 200px;" />
            </div>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-primary' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('categorias.index') }}" class="nav-link text-white {{ request()->routeIs('categorias.*') ? 'active bg-primary' : '' }}">
                        Categorías
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Usuarios
                    </a>
                </li>
<<<<<<< Updated upstream
=======
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Proveedores
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Clientes
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('categorias.index') }}" class="nav-link text-white {{ request()->routeIs('categorias.*') ? 'active bg-primary' : '' }}">
                        Categorías
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Productos
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Compras
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Ventas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Facturación
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Inventarios
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Reportes
                    </a>
                </li>
>>>>>>> Stashed changes
            </ul>
        </aside>

        {{-- Main content --}}
        <div class="flex-grow-1 d-flex flex-column">
            {{-- Topbar --}}
            <nav class="navbar navbar-expand bg-white shadow-sm px-4">
                <div class="ms-auto d-flex align-items-center gap-3">
                    <!-- Dropdown de Usuario -->
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name ?? 'Invitado' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>

            {{-- Page Content --}}
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>