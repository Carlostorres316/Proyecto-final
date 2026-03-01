<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'LearnYourway'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Estilos adicionales -->
    @stack('styles')
    
    <style>
        .cart-notification {
            animation: cartPulse 0.5s ease-in-out;
        }
        
        @keyframes cartPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); color: var(--primary-color); }
            100% { transform: scale(1); }
        }
        
        .cart-badge {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div id="app">
        {{-- Navbar principal con lógica de roles --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: var(--primary-color);">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    LearnYourway
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- Se muestran diferentes enlaces en el navbar según el rol del usuario autenticado --}}
                        @auth
                            @if(auth()->user()->rol == 'profesor')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.dashboard') }}">
                                        <i class="bi bi-grid"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.cursos.index') }}">
                                        <i class="bi bi-journals"></i> Mis Cursos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.enVivo') }}">
                                        <i class="bi bi-camera-reels"></i> En Vivo
                                    </a>
                                </li>

                            @elseif(auth()->user()->rol == 'estudiante')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('estudiante.dashboard') }}">
                                        <i class="bi bi-grid"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('estudiante.cursos') }}">
                                        <i class="bi bi-book"></i> Catálogo
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('estudiante.mis-cursos') }}">
                                        <i class="bi bi-backpack2"></i> Mis Cursos
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('estudiante.enVivo') }}">
                                        <i class="bi bi-camera-reels"></i> En Vivo
                                    </a>
                                </li>

                            @elseif(auth()->user()->rol == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-grid"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
                                        <i class="bi bi-people"></i> Usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.cursos.index') }}">
                                        <i class="bi bi-journal-bookmark-fill"></i> Cursos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.categorias.index') }}">
                                        <i class="bi bi-tags"></i> Categorías
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if(auth()->user()->rol == 'estudiante')
                                <!-- Icono de carrito para estudiantes -->
                                <li class="nav-item me-2" id="cart-icon-container">
                                    <a class="nav-link position-relative" href="{{ route('estudiante.carrito') }}" id="cart-link">
                                        <i class="bi bi-cart3 fs-5" id="cart-icon"></i>
                                        @php
                                            $carrito = session('carrito', []);
                                            $cantidad = count($carrito);
                                        @endphp
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge" id="cart-count" style="font-size: 0.7rem; {{ $cantidad == 0 ? 'display: none;' : '' }}">
                                            {{ $cantidad }}
                                            <span class="visually-hidden">items en carrito</span>
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i>
                                    {{ Auth::user()->name }}
                                    <span class="badge bg-secondary ms-2">{{ ucfirst(Auth::user()->rol) }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>