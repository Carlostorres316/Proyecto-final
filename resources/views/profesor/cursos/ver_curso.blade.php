@extends('layouts.app')

@section('title', $curso->titulo)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}" class="text-decoration-none">Mis Cursos</a></li>
                    <li class="breadcrumb-item active">{{ $curso->titulo }}</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold" style="color: var(--profesor-primary);">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>
                        {{ $curso->titulo }}
                    </h2>
                    <div class="mt-2">
                        <span class="badge curso-badge {{ $curso->nivel }} me-2">{{ ucfirst($curso->nivel) }}</span>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-tag"></i> {{ $curso->subcategoria->categoria->nombre }} > {{ $curso->subcategoria->nombre }}
                        </span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('profesor.modulos.index', $curso) }}" class="btn-profesor">
                        <i class="bi bi-layers"></i>
                        Gestionar Módulos
                    </a>
                    <a href="{{ route('profesor.cursos.edit', $curso) }}" class="btn-outline-profesor ms-2">
                        <i class="bi bi-pencil"></i>
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Info del Curso --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="profesor-card">
                <div class="card-header">
                    <i class="bi bi-info-circle me-2"></i>
                    Descripción del Curso
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $curso->descripcion }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="profesor-card">
                <div class="card-header">
                    <i class="bi bi-bar-chart me-2"></i>
                    Estadísticas
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-currency-dollar me-2" style="color: var(--profesor-primary);"></i>
                            <strong>Precio:</strong> ${{ number_format($curso->precio, 2) }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-people me-2" style="color: var(--profesor-primary);"></i>
                            <strong>Estudiantes:</strong> {{ $curso->compras->count() }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-layers me-2" style="color: var(--profesor-primary);"></i>
                            <strong>Módulos:</strong> {{ $curso->modulos->count() }}
                        </li>
                        <li>
                            <i class="bi bi-camera-reels me-2" style="color: var(--profesor-primary);"></i>
                            <strong>Lecciones:</strong> {{ $curso->modulos->sum(function($m) { return $m->lecciones->count(); }) }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Módulos del Curso --}}
    <div class="row">
        <div class="col-12 mb-3">
            <h4>
                <i class="bi bi-layers me-2" style="color: var(--profesor-primary);"></i>
                Módulos del Curso
            </h4>
        </div>

        @forelse($curso->modulos as $modulo)
            <div class="col-md-6 mb-3">
                <div class="modulo-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-2">{{ $modulo->titulo }}</h5>
                            <p class="text-muted small mb-2">{{ Str::limit($modulo->descripcion, 100) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-camera-reels"></i> {{ $modulo->lecciones->count() }} lecciones
                            </small>
                        </div>
                        <a href="{{ route('profesor.lecciones.index', $modulo) }}" 
                           class="btn btn-sm btn-outline-profesor">
                            Ver Lecciones
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="profesor-card">
                    <div class="card-body text-center py-4">
                        <p class="mb-0">Este curso aún no tiene módulos.</p>
                        <a href="{{ route('profesor.modulos.create', $curso) }}" class="btn-profesor btn-sm mt-2">
                            <i class="bi bi-plus-circle"></i>
                            Crear Primer Módulo
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
