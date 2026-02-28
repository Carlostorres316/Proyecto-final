@extends('layouts.app')

@section('title', 'Dashboard Profesor')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard del Profesor
                </h2>
            </div>
            <p class="text-muted">Bienvenido de nuevo, <span class="fw-bold">{{ Auth::user()->name }}</span></p>
        </div>
    </div>

    {{-- Cartas  --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-journals"></i>
                </div>
                <div class="stat-number">{{ $cursos->count() }}</div>
                <div class="stat-label">Total Cursos</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">
                    {{ $cursos->sum(function($curso) { return $curso->compras->count(); }) }}
                </div>
                <div class="stat-label">Estudiantes</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-camera-reels"></i>
                </div>
                <div class="stat-number">
                    {{ $cursos->sum(function($curso) { return $curso->modulos->sum(function($modulo) { return $modulo->lecciones->count(); }); }) }}
                </div>
                <div class="stat-label">Lecciones</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi-cash"></i>
                </div>
                <div class="stat-number">
                    {{--Number formart sirve redondearlo a 2 y en este caso sumar el total de valor que tiene tus cursos--}}
                    S/.{{ number_format($cursos->sum('precio'), 2) }}
                </div>
                <div class="stat-label">Valor Total</div>
            </div>
        </div>
    </div>

    {{-- Cursos Recientes --}}
    <div class="row">
        <div class="col-12 mb-3">
            <h4 class="fw-semibold">
                <i class="bi bi-clock-history me-2" style="color: var(--primary-color);"></i>
                Cursos Recientes
            </h4>
        </div>

        {{-- Mostrar los 3 cursos--}}
        @forelse($cursos->take(3) as $curso)
            <div class="col-md-4 mb-4">
                <div class="curso-card">
                    <div class="curso-img">
                        <span class="curso-badge {{ $curso->nivel }}">
                            {{ ucfirst($curso->nivel) }}
                        </span>
                    </div>
                    <div class="curso-body">
                        <h5 class="curso-titulo">{{ $curso->titulo }}</h5>
                        <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 80) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">
                                <i class="bi bi-journal"></i> {{ $curso->modulos->count() }} módulos
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-people"></i> {{ $curso->compras->count() }} estudiantes
                            </small>
                        </div>
                        
                        <div class="curso-footer">
                            {{-- Mostrar precio o GRATIS --}}
                            @if($curso->precio == 0)
                                <span class="text-success fw-bold">
                                    <i class="bi bi-gift"></i> GRATIS
                                </span>
                            @else
                                <span class="curso-precio">S/.{{ number_format($curso->precio, 2) }}</span>
                            @endif
                            
                            <div>
                                <a href="{{ route('profesor.cursos.show', $curso) }}" class="btn btn-sm btn-outline-modern me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('profesor.cursos.edit', $curso) }}" class="btn btn-sm btn-outline-modern">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-journal-x" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No tienes cursos creados</h5>
                        <p class="text-muted">Comienza creando tu primer curso en la plataforma</p>
                        <a href="{{ route('profesor.cursos.create') }}" class="btn-primary-modern mt-2">
                            <i class="bi bi-plus-circle me-2"></i>Crear Curso
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Enlace para ver todos los cursos --}}
    @if($cursos->count() > 3)
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-modern">
                    <i class="bi bi-arrow-right me-2"></i>
                    Ver todos los cursos
                </a>
            </div>
        </div>
    @endif
</div>
@endsection