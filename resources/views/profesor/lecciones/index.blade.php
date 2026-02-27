@extends('layouts.app')

@section('title', 'Lecciones del Módulo')

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
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulos->curso) }}" class="text-decoration-none">{{ $modulos->curso->titulo }}</a></li>
                    <li class="breadcrumb-item active">{{ $modulos->titulo }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold" style="color: var(--profesor-primary);">
                        <i class="bi bi-list-check me-2"></i>
                        Lecciones del Módulo
                    </h2>
                    <h5 class="text-muted">{{ $modulos->titulo }}</h5>
                </div>
                <div>
                    <a href="{{ route('profesor.lecciones.crear_leccion', $modulos) }}" class="btn-profesor">
                        <i class="bi bi-plus-circle"></i>
                        Nueva Lección
                    </a>
                    <a href="{{ route('profesor.modulos.index', $modulos->curso) }}" class="btn-outline-profesor ms-2">
                        <i class="bi bi-arrow-left"></i>
                        Volver a Módulos
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de Lecciones --}}
    <div class="row">
        <div class="col-12">
            @forelse($lecciones as $leccion)
                <div class="leccion-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-3" style="background: var(--profesor-primary) !important;">
                                <i class="bi bi-{{ $leccion->tipo == 'video' ? 'camera-reels' : ($leccion->tipo == 'texto' ? 'file-text' : 'question-circle') }}"></i>
                            </span>
                            <div>
                                <h6 class="mb-1">{{ $leccion->titulo }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $leccion->fecha_programada ? $leccion->fecha_programada->format('d/m/Y') : 'Sin fecha' }}
                                    <span class="badge bg-light text-dark ms-2">{{ ucfirst($leccion->tipo) }}</span>
                                </small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('profesor.lecciones.edit', [$modulos, $leccion]) }}" 
                               class="btn btn-sm btn-outline-profesor" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('profesor.lecciones.destroy', [$modulos, $leccion]) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('¿Eliminar esta lección?')" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="profesor-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-camera-reels" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No hay lecciones en este módulo</h5>
                        <p class="text-muted">Agrega tu primera lección para comenzar</p>
                        <a href="{{ route('profesor.lecciones.create', $modulos) }}" class="btn-profesor mt-2">
                            <i class="bi bi-plus-circle me-2"></i>Crear Primera Lección
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
