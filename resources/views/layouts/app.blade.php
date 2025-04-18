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

    <style>
        /* Sidebar scrollable */
        aside {
            height: 100vh;
            /* Full viewport height */
            overflow-y: auto;
            /* Enable vertical scroll if content overflows */
        }
    </style>

</head>

<body class="bg-light">
    <div class="d-flex">
        {{-- Sidebar --}}
        <aside id="sidebar" class="bg-dark text-white p-3 sidebar-custom">
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

                    <a href="{{ route('roles.index') }}" class="nav-link text-white {{ request()->routeIs('roles.*') ? 'active bg-primary' : '' }}">
                        Roles/Permisos
                    </a>
                </li>
                <li class="nav-item mb-2">

                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        Usuarios
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('proveedores.index') }}" class="nav-link text-white {{ request()->routeIs('proveedores.*') ? 'active bg-primary' : '' }}">
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
            </ul>
        </aside>

        {{-- Main content --}}
        <div class="flex-grow-1 d-flex flex-column">
            {{-- Topbar --}}
            <nav class="topbar d-flex justify-content-between align-items-center">
                <!-- Botón hamburguesa para pantallas pequeñas -->
                <button id="toggle-sidebar" class="btn text-white d-md-none ms-2" style="font-size: 1.5rem; background: none; border: none;">
                    ☰
                </button>

                <!-- Contenedor derecho (usuario) -->
                <div class="ms-auto d-flex align-items-center gap-3">
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
            <main class="p-4" style="padding-top: 80px;">
                <div class="container-fluid">
                    @yield('content')
                </div>
                
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    
    @vite('resources/js/sidebar.js')
</body>

</html>