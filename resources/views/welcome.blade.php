@extends('layouts.app')

@section('content')
<!-- HERO SECTION - BANNER PRINCIPAL -->
<div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center min-vh-50 py-5">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4" style="color: var(--gray-800);">
                    Aprende las habilidades <span style="color: var(--primary-color);">del futuro</span>
                </h1>
                <p class="lead mb-4" style="color: var(--gray-600); font-size: 1.3rem;">
                    Más de 10,000 cursos en tecnología, negocios, diseño y más. Aprende a tu ritmo con los mejores instructores.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('estudiante.cursos') }}" class="btn btn-primary-modern btn-lg">
                        <i class="bi bi-play-circle"></i> Explorar Cursos
                    </a>
                    <a href="#categorias" class="btn btn-outline-modern btn-lg">
                        <i class="bi bi-grid"></i> Ver Categorías
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                         alt="Estudiantes" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute bottom-0 start-0 bg-white p-3 rounded-4 m-3 shadow">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill text-primary-modern fs-3 me-2"></i>
                            <div>
                                <span class="fw-bold">+50,000</span>
                                <span class="text-muted d-block">estudiantes</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CATEGORÍAS POPULARES - ESTILO UDEMY -->
<div class="container mb-5" id="categorias">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-grid-3x3-gap-fill me-2" style="color: var(--primary-color);"></i>
            Categorías populares
        </h2>
        <a href="{{ route('estudiante.cursos') }}" class="text-decoration-none" style="color: var(--primary-color);">
            Ver todas <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($categorias->take(6) as $categoria)
        <div class="col-md-4 col-lg-2">
            <a href="{{ route('estudiante.cursos') }}?categoria={{ $categoria->id }}" class="text-decoration-none">
                <div class="card-categoria text-center p-4">
                    <div class="categoria-icon mb-3">
                        @switch($categoria->nombre)
                            @case('Desarrollo de Software')
                                <i class="bi bi-code-slash fs-1"></i>
                                @break
                            @case('Negocios')
                                <i class="bi bi-briefcase fs-1"></i>
                                @break
                            @case('Finanzas e Inversiones')
                                <i class="bi bi-graph-up-arrow fs-1"></i>
                                @break
                            @case('Diseño')
                                <i class="bi bi-palette fs-1"></i>
                                @break
                            @case('Marketing')
                                <i class="bi bi-megaphone fs-1"></i>
                                @break
                            @default
                                <i class="bi bi-book fs-1"></i>
                        @endswitch
                    </div>
                    <h6 class="fw-bold mb-2">{{ $categoria->nombre }}</h6>
                    <p class="text-muted small mb-0">{{ $categoria->subcategorias->sum(fn($sub) => $sub->cursos->count()) }} cursos</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<!-- SUBCATEGORÍAS DESTACADAS -->
<div class="container mb-5">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-tags me-2" style="color: var(--primary-color);"></i>
        Explora por subcategorías
    </h2>
    
    <div class="row g-3">
        @foreach($categorias as $categoria)
            @foreach($categoria->subcategorias->take(2) as $subcategoria)
                <div class="col-md-3">
                    <a href="{{ route('estudiante.cursos') }}?subcategoria={{ $subcategoria->id }}" 
                       class="text-decoration-none">
                        <div class="card-subcategoria p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="subcategoria-icon">
                                        <i class="bi bi-folder"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $subcategoria->nombre }}</h6>
                                    <small class="text-muted">{{ $subcategoria->cursos->count() }} cursos</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<!-- CURSOS DESTACADOS -->
<div class="container mb-5">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-star-fill me-2" style="color: #f59e0b;"></i>
        Cursos destacados
    </h2>

    <div class="row g-4">
        @foreach($cursosDestacados as $curso)
        <div class="col-md-3">
            <div class="curso-card h-100">
                <div class="curso-img position-relative">
                    <div class="curso-badge {{ $curso->nivel }}">{{ ucfirst($curso->nivel) }}</div>
                </div>
                <div class="curso-body">
                    <h6 class="curso-titulo">{{ Str::limit($curso->titulo, 50) }}</h6>
                    <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 80) }}</p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-person-circle me-2 text-muted"></i>
                        <small class="text-muted">{{ $curso->profesor->name }}</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-tag me-2 text-muted"></i>
                        <small class="text-muted">{{ $curso->subcategoria->categoria->nombre }} / {{ $curso->subcategoria->nombre }}</small>
                    </div>
                    <div class="curso-footer">
                        @if($curso->precio > 0)
                            <span class="curso-precio">S/.{{ number_format($curso->precio, 2) }}</span>
                        @else
                            <span class="badge bg-success">Gratis</span>
                        @endif
                        <a href="{{ route('estudiante.curso.ver', $curso->id) }}" class="btn btn-sm btn-outline-modern">
                            Ver curso
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-gift-fill me-2" style="color: #10b981;"></i>
            Cursos gratis
        </h2>
        <a href="{{ route('estudiante.cursos') }}?precio=gratis" class="text-decoration-none" style="color: var(--primary-color);">
            Ver todos <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($cursosGratis as $curso)
        <div class="col-md-3">
            <div class="curso-card h-100">
                <div class="curso-img position-relative">
                    <div class="curso-badge {{ $curso->nivel }}">{{ ucfirst($curso->nivel) }}</div>
                </div>
                <div class="curso-body">
                    <h6 class="curso-titulo">{{ Str::limit($curso->titulo, 50) }}</h6>
                    <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 80) }}</p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-person-circle me-2 text-muted"></i>
                        <small class="text-muted">{{ $curso->profesor->name }}</small>
                    </div>
                    <div class="curso-footer">
                        <span class="badge bg-success">100% gratis</span>
                        <a href="{{ route('estudiante.curso.ver', $curso->id) }}" class="btn btn-sm btn-outline-modern">
                            Ver curso
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- CURSOS PARA PRINCIPIANTES -->
<div class="container mb-5">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-arrow-up-circle-fill me-2" style="color: var(--primary-color);"></i>
        Para principiantes
    </h2>

    <div class="row g-4">
        @foreach($cursosPrincipiantes as $curso)
        <div class="col-md-3">
            <div class="curso-card h-100">
                <div class="curso-img position-relative">
                    <div class="curso-badge {{ $curso->nivel }}">{{ ucfirst($curso->nivel) }}</div>
                </div>
                <div class="curso-body">
                    <h6 class="curso-titulo">{{ Str::limit($curso->titulo, 50) }}</h6>
                    <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 80) }}</p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-person-circle me-2 text-muted"></i>
                        <small class="text-muted">{{ $curso->profesor->name }}</small>
                    </div>
                    <div class="curso-footer">
                        @if($curso->precio > 0)
                            <span class="curso-precio">S/.{{ number_format($curso->precio, 2) }}</span>
                        @else
                            <span class="badge bg-success">Gratis</span>
                        @endif
                        <a href="{{ route('estudiante.curso.ver', $curso->id) }}" class="btn btn-sm btn-outline-modern">
                            Ver curso
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <div class="banner-registro p-5 rounded-4 text-white text-center" 
                 style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
                <h2 class="fw-bold mb-3">¿Listo para comenzar tu viaje de aprendizaje?</h2>
                <p class="mb-4 opacity-75">Únete a miles de estudiantes que ya están aprendiendo en LearnYourway</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                        <i class="bi bi-person-plus"></i> Regístrate gratis
                    </a
                @else
                    <a href="{{ route('estudiante.cursos') }}" class="btn btn-light btn-lg px-5">
                        <i class="bi bi-play-circle"></i> Comenzar a aprender
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')

@endpush