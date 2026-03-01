@extends('layouts.app')

@section('title', $leccion->titulo)

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-modern mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('estudiante.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.mis-cursos') }}">Mis Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.curso.ver', $curso) }}">{{ $curso->titulo }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiante.modulo.ver', [$curso->id, $modulo->id]) }}">{{ $modulo->titulo }}</a></li>
            <li class="breadcrumb-item active">{{ $leccion->titulo }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $leccion->titulo }}</h4>
                    <span class="badge bg-primary">{{ ucfirst($leccion->tipo) }}</span>
                </div>
                <div class="curso-body">
                    @if($leccion->tipo == 'video' && $leccion->url_video)
                        <div class="ratio ratio-16x9 mb-4">
                            <iframe src="{{ $leccion->url_video }}" title="{{ $leccion->titulo }}" allowfullscreen></iframe>
                        </div>
                    @endif

                    @if($leccion->contenido)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Contenido de la Lección</h5>
                            <div class="p-3 bg-light rounded">
                                {{ $leccion->contenido }}
                            </div>
                        </div>
                    @endif

                    @if($leccion->tipo == 'pregunta')
                        <div class="alert alert-info alert-modern">
                            <i class="bi bi-question-circle-fill me-2"></i>
                            Esta es una lección de tipo pregunta. Completa el ejercicio para continuar.
                        </div>
                        
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Tu respuesta:</label>
                                <textarea class="form-control" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary-modern">
                                <i class="bi bi-send me-2"></i>
                                Enviar Respuesta
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-modern sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0">Navegación</h5>
                </div>
                <div class="curso-body">
                    <a href="{{ route('estudiante.modulo.ver', [$curso->id, $modulo->id]) }}" class="btn-outline-modern w-100 mb-3">
                        <i class="bi bi-arrow-left me-2"></i>
                        Volver al Módulo
                    </a>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <button class="btn-outline-modern btn-sm" disabled>
                            <i class="bi bi-chevron-left"></i> Anterior
                        </button>
                        <button class="btn-primary-modern btn-sm">
                            Siguiente <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection