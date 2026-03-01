@extends('layouts.app')

@section('title', 'Catálogo de Cursos')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                <i class="bi bi-book me-2"></i>
                Catálogo de Cursos
            </h2>
        </div>
        <div class="col-md-4">
            <form action="{{ route('estudiante.cursos') }}" method="GET" class="d-flex">
                <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar cursos..." value="{{ request('buscar') }}">
                <button type="submit" class="btn-primary-modern">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    @if(session('carrito_agregado'))
        <div class="alert alert-success alert-modern mb-4">
            <i class="bi bi-cart-check-fill me-2"></i>
            {{ session('carrito_agregado') }}
            <a href="{{ route('estudiante.carrito') }}" class="alert-link ms-2">Ver carrito</a>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-modern mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @forelse($cursos as $curso)
            <div class="col-md-4 mb-4">
                <div class="curso-card h-100">
                    <div class="curso-img">
                        <span class="curso-badge {{ $curso->nivel }}">{{($curso->nivel) }}</span>
                    </div>
                    <div class="curso-body">
                        <h5 class="curso-titulo">{{ $curso->titulo }}</h5>
                        <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 100) }}</p>
                        
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ $curso->profesor->name ?? 'Instructor' }}
                            </small>
                        </div>

                        <div class="curso-footer">
                            @if($curso->precio > 0)
                                <span class="curso-precio">S/.{{ number_format($curso->precio, 2) }}</span>
                            @else
                                <span class="badge bg-success">GRATIS</span>
                            @endif

                            @php
                                $yaComprado = Auth::user()->comprasEstudiante()->where('curso_id', $curso->id)->exists();
                            @endphp

                            @if($yaComprado)
                                <a href="{{ route('estudiante.curso.ver', $curso) }}" class="btn-primary-modern">
                                    <i class="bi bi-play-circle"></i> Ir al curso
                                </a>
                            @else
                                @if($curso->precio > 0)
                                    <form action="{{ route('estudiante.carrito.agregar', $curso) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-outline-modern btn-sm">
                                            <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('estudiante.comprar-curso', $curso) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary-modern btn-sm">
                                            <i class="bi bi-box-arrow-in-right"></i> Inscribirme Gratis
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern text-center py-5">
                    <i class="bi bi-emoji-frown" style="font-size: 3rem; color: var(--gray-600);"></i>
                    <h5 class="mt-3">No hay cursos disponibles</h5>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection