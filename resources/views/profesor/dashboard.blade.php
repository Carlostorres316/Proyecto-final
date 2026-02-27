@extends('layouts.app')

@section('title', 'Dashboard Profesor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold" style="color: var(--profesor-primary);">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard del Profesor
                </h2>
                <a href="{{ route('profesor.cursos.create') }}" class="btn-profesor">
                    <i class="bi bi-plus-circle"></i>
                    Nuevo Curso
                </a>
            </div>
            <p class="text-muted">Bienvenido de nuevo, <span class="fw-bold">{{ Auth::user()->name }}</span></p>
        </div>
    </div>

    {{-- Stats Cards --}}
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
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-number">
                    ${{ number_format($cursos->sum('precio'), 2) }}
                </div>
                <div class="stat-label">Valor Total</div>
            </div>
        </div>
    </div>

    {{-- Cursos Recientes --}}
    <div class="row">
        <div class="col-12 mb-3">
            <h4 class="fw-semibold">
                <i class="bi bi-clock-history me-2" style="color: var(--profesor-primary);"></i>
                Cursos Recientes
            </h4>
        </div>

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
                            <span class="curso-precio">${{ number_format($curso->precio, 2) }}</span>
                            <div>
                                <a href="{{ route('profesor.cursos.show', $curso) }}" class="btn btn-sm btn-outline-profesor me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('profesor.cursos.edit', $curso) }}" class="btn btn-sm btn-outline-profesor">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="profesor-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-journal-x" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No tienes cursos creados</h5>
                        <p class="text-muted">Comienza creando tu primer curso en la plataforma</p>
                        <a href="{{ route('profesor.cursos.create') }}" class="btn-profesor mt-2">
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
                <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-profesor">
                    <i class="bi bi-arrow-right me-2"></i>
                    Ver todos los cursos
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
