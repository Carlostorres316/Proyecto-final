@extends('layouts.app')

@section('title', $curso->titulo)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
                    <li class="breadcrumb-item active">{{ $curso->titulo }}</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold" style="color: var(--primary-color);">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>
                        {{ $curso->titulo }}
                    </h2>
                    <div class="mt-2">
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-tag"></i> {{ $curso->subcategoria->categoria->nombre }} > {{ $curso->subcategoria->nombre }}
                        </span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('profesor.modulos.index', $curso) }}" class="btn-primary-modern">
                        <i class="bi bi-layers"></i>
                        Gestionar Módulos
                    </a>
                    <a href="{{ route('profesor.cursos.edit', $curso) }}" class="btn-outline-modern ms-2">
                        <i class="bi bi-pencil"></i>
                        Editar
                    </a>
                    <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-modern ms-2">
                        <i class="bi bi-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Info del Curso --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card-modern">
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
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-bar-chart me-2"></i>
                    Información General
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi-cash me-2" style="color: var(--primary-color);"></i>
                            <strong>Precio:</strong> 
                            @if($curso->precio == 0)
                                <span class="text-success fw-bold">GRATIS</span>
                            @else
                                {{-- Con number_format se formatea el número a 2 decimales, esto es diseño para que se vea mejor el precio--}}
                                {{ number_format($curso->precio, 2) }}
                            @endif
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-people me-2" style="color: var(--primary-color);"></i>
                            <strong>Estudiantes:</strong> {{ $curso->compras->count() }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-layers me-2" style="color: var(--primary-color);"></i>
                            <strong>Módulos:</strong> {{ $curso->modulos->count() }}
                        </li>
                        <li>
                            <i class="bi bi-camera-reels me-2" style="color: var(--primary-color);"></i>
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
                <i class="bi bi-layers me-2" style="color: var(--primary-color);"></i>
                Módulos del Curso
            </h4>
        </div>

        @forelse($curso->modulos as $modulo)
            <div class="col-md-6 mb-3">
                <div class="modulo-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-2">{{ $modulo->titulo }}</h5>
                            {{--Con str limit lo que se hace es cortar el texto original osea no muestra todo completo solo una parte ,esto es diseño mas que todo profesor--}}
                            <p class="text-muted small mb-2">{{ Str::limit($modulo->descripcion, 100) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-camera-reels"></i> {{ $modulo->lecciones->count() }} lecciones
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern">
                    <div class="card-body text-center py-4">
                        <p class="mb-0">Este curso aún no tiene módulos.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection