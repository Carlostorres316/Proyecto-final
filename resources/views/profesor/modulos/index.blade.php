@extends('layouts.app')

@section('title', 'Módulos del Curso')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-modern">
            <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
            <li class="breadcrumb-item active">Módulos de {{ $curso->titulo }}</li>
        </ol>
    </nav>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: var(--primary-color);">
            <i class="bi bi-layers me-2"></i>
            Módulos del curso: {{ $curso->titulo }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('profesor.modulos.create', $curso) }}" class="btn-primary-modern" title="Crear nuevo módulo">
                <i class="bi bi-plus-circle"></i>
                <span class="d-none d-md-inline ms-1">Crear módulo</span>
            </a>
            <a href="{{ route('profesor.cursos.show', $curso) }}" class="btn-outline-modern">
                <i class="bi bi-arrow-left"></i>
                <span class="d-none d-md-inline ms-1">Volver</span>
            </a>
        </div>
    </div>

    @foreach($modulos as $modulo)
        <div class="card-modern mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary me-2">{{ $modulo->orden}}</span>
                    <strong>{{ $modulo->titulo }}</strong>
                    <a href="{{ route('profesor.modulos.edit', [$curso, $modulo]) }}" class="btn btn-sm bg-light " title="Editar módulo">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('profesor.modulos.destroy', [$curso, $modulo]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm bg-light" onclick="return confirm('¿Eliminar módulo?')" title="Eliminar módulo">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
                <button class="btn btn-sm bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#modulo{{ $modulo->id }}">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            <div id="modulo{{ $modulo->id }}" class="collapse show">
                <div class="card-body">
                    {{-- Header de lecciones con botón + al lado derecho --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            &nbsp;&nbsp;
                            &nbsp;&nbsp;
                            <i class="bi bi-journals me-2" style="color: var(--primary-color);"></i>
                            Lecciones
                        </h5>
                        <a href="{{ route('profesor.lecciones.create', $modulo) }}" 
                           class="btn-primary-modern btn-sm" 
                           title="Crear nueva lección">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>

                    {{-- Lista de lecciones --}}
                    @forelse($modulo->lecciones as $leccion)
                        <div class="leccion-item mb-2 p-3 border rounded" style="transition: all 0.3s; hover:shadow-sm;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong>{{ $leccion->titulo }}</strong>
                                    </div>
                                    
                                    {{-- Detalle según tipo de lección --}}
                                    <div class="mt-1">
                                        @if($leccion->tipo == 'video' && $leccion->url_video)
                                            <small class="text-muted">
                                                <i class="bi bi-link-45deg"></i> 
                                                <a href="{{ $leccion->url_video }}" target="_blank" class="text-decoration-none">
                                                    {{-- Con str limit lo que se hace es cortar el texto original osea no muestra todo completo solo una parte ,esto es diseño mas que todo profesor--}}
                                                    {{ Str::limit($leccion->url_video, 40) }}
                                                </a>
                                            </small>
                                        @elseif($leccion->tipo == 'pregunta' && $leccion->contenido)
                                            <small class="text-muted d-block">
                                                <i class="bi bi-chat-quote"></i> 
                                                <span class="fst-italic">"{{ Str::limit($leccion->contenido, 60) }}"</span>
                                            </small>
                                        @elseif($leccion->contenido)
                                            <small class="text-muted d-block">
                                                <i class="bi bi-file-text"></i> 
                                                {{ Str::limit($leccion->contenido, 60) }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Botones de lección --}}
                                <div class="d-flex gap-1 ms-3">
                                    <a href="{{ route('profesor.lecciones.show', [$modulo, $leccion]) }}" 
                                       class="btn btn-sm btn-outline-modern" 
                                       title="Ver lección">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <form action="{{ route('profesor.lecciones.destroy', [$modulo, $leccion]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-modern" 
                                                title="Eliminar lección" 
                                                onclick="return confirm('¿Eliminar lección?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 bg-light rounded">
                            <i class="bi bi-journal-x" style="font-size: 2rem; color: #cbd5e1;"></i>
                            <p class="text-muted mt-2 mb-0">No hay lecciones en este módulo aún.</p>
                            <a href="{{ route('profesor.lecciones.create', $modulo) }}" class="btn-primary-modern btn-sm mt-2">
                                <i class="bi bi-plus-circle"></i>
                                Crear primera lección
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection