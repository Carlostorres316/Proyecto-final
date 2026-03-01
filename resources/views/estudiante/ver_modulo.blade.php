@extends('layouts.app')

@section('title', $modulo->titulo)

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-modern mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('estudiante.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.mis-cursos') }}">Mis Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.curso.ver', $curso) }}">{{ $curso->titulo }}</a></li>
            <li class="breadcrumb-item active">{{ $modulo->titulo }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card-modern mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ $modulo->titulo }}</h4>
                </div>
                <div class="curso-body">
                    <p class="curso-descripcion">{{ $modulo->descripcion }}</p>
                </div>
            </div>

            <div class="card-modern">
                <div class="card-header">
                    <h5 class="mb-0">Lecciones del Módulo</h5>
                </div>
                <div class="curso-body">
                    @forelse($modulo->lecciones as $leccion)
                        <div class="leccion-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi 
                                    @if($leccion->tipo == 'video') bi-camera-reels
                                    @elseif($leccion->tipo == 'pregunta') bi-question-circle
                                    @else bi-file-text
                                    @endif me-2" style="color: var(--primary-color);">
                                </i>
                                <a href="{{ route('estudiante.leccion.ver', [$curso->id, $modulo->id, $leccion->id]) }}" class="text-dark">
                                    {{ $leccion->titulo }}
                                </a>
                            </div>
                            <span class="badge bg-light text-dark">{{ ucfirst($leccion->tipo) }}</span>
                        </div>
                    @empty
                        <p class="text-center text-muted">Este módulo no tiene lecciones</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-modern sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0">Progreso del Módulo</h5>
                </div>
                <div class="curso-body">
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" style="width: 0%; background: var(--primary-color);"></div>
                    </div>
                    <p class="text-center text-muted small">0/{{ $modulo->lecciones->count() }} lecciones completadas</p>
                    
                    <hr>
                    
                    <a href="{{ route('estudiante.curso.ver', $curso) }}" class="btn-outline-modern w-100">
                        <i class="bi bi-arrow-left me-2"></i>
                        Volver al Curso
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection