@extends('layouts.app')

@section('title', $curso->titulo)

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="breadcrumb-modern mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('estudiante.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.mis-cursos') }}">Mis Cursos</a></li>
            <li class="breadcrumb-item active">{{ $curso->titulo }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card-modern mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ $curso->titulo }}</h4>
                </div>
                <div class="curso-body">
                    <p class="curso-descripcion">{{ $curso->descripcion }}</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                <i class="bi bi-person-circle me-2"></i>
                                Instructor: {{ $curso->profesor->name ?? 'No especificado' }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">
                                <i class="bi bi-bar-chart me-2"></i>
                                Nivel: <span class="badge-nivel {{ $curso->nivel }}">{{($curso->nivel) }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Módulos y Lecciones -->
            <div class="card-modern">
                <div class="card-header">
                    <h5 class="mb-0">Contenido del Curso</h5>
                </div>
                <div class="curso-body">
                    @forelse($curso->modulos as $modulo)
                        <div class="modulo-item">
                            <h5 class="d-flex justify-content-between align-items-center">
                                {{ $modulo->titulo }}
                                <span class="badge bg-secondary">{{ $modulo->lecciones->count() }} lecciones</span>
                            </h5>
                            <p class="text-muted small">{{ $modulo->descripcion }}</p>
                            
                            @foreach($modulo->lecciones as $leccion)
                                <div class="leccion-item d-flex justify-content-between align-items-center">
                                    <div class="card-modern">
                                        <i class="bi 
                                            @if($leccion->tipo == 'video') bi-camera-reels
                                            @elseif($leccion->tipo == 'pregunta') bi-question-circle
                                            @else bi-file-text
                                            @endif me-2">
                                        </i>
                                        <a href="{{ route('estudiante.leccion.ver', [$curso->id, $modulo->id, $leccion->id]) }}" class="text-dark">
                                            {{ $leccion->titulo }}
                                        </a>
                                    </div>
                                    <span class="badge bg-light text-dark">{{($leccion->tipo) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <p class="text-center text-muted">Este curso aún no tiene módulos</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-modern sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0">Información del Curso</h5>
                </div>
                <div class="curso-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-calendar-check me-2 text-primary"></i>
                            <strong>Creado:</strong> {{ $curso->fecha_creacion->format('d/m/Y') }}
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-collection me-2 text-primary"></i>
                            <strong>Módulos:</strong> {{ $curso->modulos->count() }}
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-journal-text me-2 text-primary"></i>
                            <strong>Lecciones:</strong> 
                            @php
                                $totalLecciones = 0;
                                foreach($curso->modulos as $modulo) {
                                    $totalLecciones += $modulo->lecciones->count();
                                }
                            @endphp
                            {{ $totalLecciones }}
                        </li>
                    </ul>

                    <hr>

                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" style="width: 0%; background: var(--primary-color);"></div>
                    </div>
                    <p class="text-center text-muted small">0% completado</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection