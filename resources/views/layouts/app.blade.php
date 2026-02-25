<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LearnYourway') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    LearnYourway
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->rol == 'estudiante')
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
                                        <i class="bi bi-collection-play"></i> Mis Cursos
                                    </a>
                                </li>
                            @elseif(auth()->user()->rol == 'profesor')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.dashboard') }}">
                                        <i class="bi bi-grid"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.cursos') }}">
                                        <i class="bi bi-journal-bookmark-fill"></i> Mis Cursos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profesor.clases-vivo') }}">
                                        <i class="bi bi-camera-video"></i> Clases en Vivo
                                    </a>
                                </li>
                            @elseif(auth()->user()->rol == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-grid"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.usuarios') }}">
                                        <i class="bi bi-people"></i> Usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.cursos') }}">
                                        <i class="bi bi-journal-bookmark-fill"></i> Cursos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.reportes') }}">
                                        <i class="bi bi-graph-up"></i> Reportes
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle"></i>
                                    {{ Auth::user()->name }}
                                    <span class="badge {{ Auth::user()->rol == 'estudiante' ? 'badge-estudiante' : (Auth::user()->rol == 'profesor' ? 'badge-profesor' : 'badge-admin') }}">
                                        {{ ucfirst(Auth::user()->rol) }}
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
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
</body>
</html>