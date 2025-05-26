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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- InputMask CDN -->
    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.es6.min.js"></script>
    <script src="https://unpkg.com/inputmask@5.0.8/dist/bundle/inputmask.bundle.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/sidebar.js','resources/js/alertas.js'])    

    <style>
        /* Sidebar scrollable */
        aside {
            height: 100vh;
            /* Full viewport height */
            overflow-y: auto;
            /* Enable vertical scroll if content overflows */
        }
    </style>

    @yield('css')

</head>

<body class="bg-light">
    <div class="wrapper d-flex flex-column flex-md-row overflow-hidden">
        {{-- Sidebar --}}
        <aside id="sidebar" class="bg-dark text-white p-3 sidebar-custom" style="width: 250px; min-width: 250px;">            
            <!-- Logo de la empresa en lugar de texto -->
            <div class="mb-4">
                <img src="{{ asset('images/logo_don_valentin.jpeg') }}" alt="Logo de la Empresa" class="img-fluid rounded-circle" style="max-width: 200px;" />
            </div>
            <ul class="nav nav-pills flex-column">                
                <li class="nav-item mb-2">                    
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>                

                @can('Ver roles')
                <li class="nav-item mb-2">
                    <a href="{{ route('roles.index') }}" class="nav-link text-white {{ request()->routeIs('roles.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-shield-lock-fill"></i> Roles/Permisos
                    </a>
                </li>
                @endcan

                @can('Ver usuarios')
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-person-fill"></i> Usuarios
                    </a>
                </li>
                @endcan

                @can('Ver proveedores')
                <li class="nav-item mb-2">
                    <a href="{{ route('proveedores.index') }}" class="nav-link text-white {{ request()->routeIs('proveedores.*') ? 'active bg-primary' : '' }}">                        
                        <i class="bi bi-person-vcard-fill"></i> Proveedores
                    </a>
                </li>
                @endcan

                @can('Ver clientes')
                <li class="nav-item mb-2">
                    <a href="{{ route('clientes.index') }}" class="nav-link text-white {{ request()->routeIs('clientes.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-person-lines-fill"></i> Clientes
                    </a>
                </li>
                @endcan

                @can('Ver categorias')
                <li class="nav-item mb-2">
                    <a href="{{ route('categorias.index') }}" class="nav-link text-white {{ request()->routeIs('categorias.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-tags-fill"></i> Categorías
                    </a>
                </li>
                @endcan

                @can('Ver productos')
                <li class="nav-item mb-2">
                    <a href="{{ route('productos.index') }}" class="nav-link text-white {{ request()->routeIs('productos.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-box-seam"></i> Productos
                    </a>
                </li>
                @endcan

                @can('Ver compras')
                <li class="nav-item mb-2">
                    <a href="{{ route('compras.index') }}" class="nav-link text-white {{ request()->routeIs('compras.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-cart-check-fill"></i> Compras
                    </a>
                </li>
                @endcan
                @can('Ver ventas')
                <li class="nav-item mb-2">
                    <a href="{{ route('ventas.index') }}" class="nav-link text-white {{ request()->routeIs('ventas.*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-cash-stack"></i> Ventas
                    </a>
                </li>
                @endcan
                @can('Ver facturacion')
                <li class="nav-item mb-2">
                    <a href="" class="nav-link text-white">
                        <i class="bi bi-receipt-cutoff"></i> Facturación
                    </a>
                </li>
                @endcan
                @can('Ver inventarios')
                <li class="nav-item mb-2">
                    <a href="" class="nav-link text-white">
                        <i class="bi bi-archive-fill"></i> Inventarios
                    </a>
                </li>
                @endcan
                @can('Ver reportes')
                <li class="nav-item mb-2">
                    <a href="{{ route('reportes.index') }}" class="nav-link text-white">
                        <i class="bi bi-file-earmark-text"></i> Reportes
                    </a>
                </li>
                @endcan
            </ul>
        </aside>

        {{-- Main content --}}
        <div class="flex-grow-1 d-flex flex-column overflow-auto">
            {{-- Topbar --}}
            <nav class="topbar d-flex justify-content-between align-items-center">
                <!-- Botón hamburguesa para pantallas pequeñas -->
                <button id="toggle-sidebar" class="btn text-white d-lg-none ms-2" style="font-size: 1.5rem; background: none; border: none;" ...>
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
                            @can('Crear respaldos')
                                <li>
                                    <a class="dropdown-item" href="{{ route('backup.index') }}">Respaldo</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endcan                            
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
                <div class="container-fluid">
                    @yield('content')
                </div>

            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>        

    @yield('page_js')
</body>

</html>