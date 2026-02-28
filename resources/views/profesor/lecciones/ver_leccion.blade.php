@extends('layouts.app')

@section('title', $leccion->titulo)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulo->curso) }}">{{ $modulo->curso->titulo }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulo->curso) }}">{{ $modulo->titulo }}</a></li>
                    <li class="breadcrumb-item active">{{ $leccion->titulo }}</li>
                </ol>
            </nav>

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-eye me-2"></i>
                    {{ $leccion->titulo }}
                </h2>
                <div>
                    <a href="{{ route('profesor.modulos.index', $modulo->curso) }}" class="btn-outline-modern">
                        <i class="bi bi-arrow-left"></i>
                        Volver a Módulos
                    </a>
                </div>
            </div>

            {{-- Contenido de la lección --}}
            <div class="card-modern mb-4">
                <div class="card-header">
                    <i class="bi bi-info-circle me-2"></i>
                    Información de la Lección
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Título:</div>
                        <div class="col-md-9">{{ $leccion->titulo }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Tipo:</div>
                        <div class="col-md-9">
                            <span class="">{{ ($leccion->tipo) }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Módulo:</div>
                        <div class="col-md-9">{{ $modulo->titulo }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Curso:</div>
                        <div class="col-md-9">{{ $modulo->curso->titulo }}</div>
                    </div>
                </div>
            </div>

            {{-- Contenido específico según el tipo --}}
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-file-text me-2"></i>
                    Contenido de la Lección
                </div>
                <div class="card-body">
                    @if($leccion->tipo == 'video' && $leccion->url_video)
                        <div class="mt-3">
                            <a href="{{ $leccion->url_video }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-box-arrow-up-right"></i> Abrir video en nueva pestaña
                            </a>
                        </div>

                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $leccion->url_video }}" title="{{ $leccion->titulo }}"></iframe>
                        </div>

                    @elseif($leccion->tipo == 'material' && $leccion->contenido)
                        <div class="text-center mb-3">
                            <i class="bi bi-file-text" style="font-size: 3rem; color: var(--primary-color);"></i>
                            <h5 class="mt-2">Material de estudio</h5>
                        </div>
                        <div class="p-4 bg-light rounded">
                            {{ $leccion->contenido }}
                        </div>
                    @elseif($leccion->tipo == 'pregunta' && $leccion->contenido)
                        <div class="text-center mb-3">
                            
                            <i class="bi bi-question-circle" style="font-size: 3rem; color: var(--primary-color);"></i>
                            <h5 class="mt-2">Pregunta para los estudiantes</h5>
                        </div>
                        <div class="p-4 bg-light rounded">
                            <strong>Pregunta:</strong>
                            <p class="mt-2">{{ $leccion->contenido }}</p>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-file-earmark-x" style="font-size: 3rem; color: #cbd5e1;"></i>
                            <p class="mt-3 text-muted">Esta lección no tiene contenido disponible.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('profesor.modulos.index', $modulo->curso) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver a Módulos
                </a>
                <div>
                    <a href="{{ route('profesor.lecciones.create', $modulo) }}" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> Nueva Lección
                    </a>
                    <form action="{{ route('profesor.lecciones.destroy', [$modulo, $leccion]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar lección?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection