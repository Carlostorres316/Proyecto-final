@extends('layouts.app')

@section('title', 'Crear Lección')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Header --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}" class="text-decoration-none">Mis Cursos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulos->curso) }}" class="text-decoration-none">{{ $modulos->curso->titulo }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.lecciones.index', $modulos) }}" class="text-decoration-none">{{ $modulos->titulo }}</a></li>
                    <li class="breadcrumb-item active">Nueva Lección</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--profesor-primary);">
                    <i class="bi bi-plus-circle me-2"></i>
                    Crear Nueva Lección
                </h2>
                <a href="{{ route('profesor.lecciones.index', $modulos) }}" class="btn-outline-profesor">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            {{-- Formulario --}}
            <div class="form-card">
                <form action="{{ route('profesor.lecciones.store', $modulos) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título de la Lección</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Lección</label>
                        <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                            <option value="">Selecciona el tipo</option>
                            <option value="video" {{ old('tipo') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="texto" {{ old('tipo') == 'texto' ? 'selected' : '' }}>Texto</option>
                            <option value="quiz" {{ old('tipo') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="url_contenido" class="form-label">URL del Contenido (opcional)</label>
                        <input type="url" class="form-control @error('url_contenido') is-invalid @enderror" 
                               id="url_contenido" name="url_contenido" value="{{ old('url_contenido') }}"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <small class="text-muted">Para videos de YouTube, Vimeo, etc.</small>
                        @error('url_contenido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fecha_programada" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control @error('fecha_programada') is-invalid @enderror" 
                               id="fecha_programada" name="fecha_programada" 
                               value="{{ old('fecha_programada', now()->format('Y-m-d')) }}" required>
                        @error('fecha_programada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-profesor">
                            <i class="bi bi-save me-2"></i>
                            Crear Lección
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection