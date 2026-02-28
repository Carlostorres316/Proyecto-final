@extends('layouts.app')

@section('title', 'Crear Lección')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulo->curso) }}">{{ $modulo->curso->titulo }}</a></li>
                    <li class="breadcrumb-item active">Crear Lección en: {{ $modulo->titulo }}</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-plus-circle me-2"></i>
                    Crear lección para: {{ $modulo->titulo }}
                </h2>
                <a href="{{ route('profesor.modulos.index', $modulo->curso) }}" class="btn-outline-modern">
                    <i class="bi bi-arrow-left"></i>
                    Volver a Módulos
                </a>
            </div>

            <div class="form-card">
                <form action="{{ route('profesor.lecciones.store', $modulo) }}" method="POST">
                    @csrf
                    {{--Formulario para crear una nueva lección, se envía al método store del controlador de lecciones, se pasan el módulo para asociar la lección a ese módulo--}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Título</label>
                        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo</label>
                        <select name="tipo" id="tipoSelect" class="form-select @error('tipo') is-invalid @enderror" required>
                            <option value="material">Material</option>
                            <option value="pregunta">Pregunta</option>
                            <option value="video">Video</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="contenidoDiv">
                        <label class="form-label fw-bold">Contenido</label>
                        <textarea name="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="4">{{ old('contenido') }}</textarea>
                        @error('contenido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 d-none" id="videoDiv">
                        <label class="form-label fw-bold">URL del Video</label>
                        <input type="url" name="url_video" class="form-control @error('url_video') is-invalid @enderror" value="{{ old('url_video') }}" placeholder="https://www.youtube.com/watch?v=...">
                        @error('url_video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-primary-modern py-2">
                            <i class="bi bi-save me-2"></i>
                            Guardar Lección
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{--Este script se encarga de mostrar u ocultar los campos de contenido y URL de video según el tipo de lección seleccionado--}}
{{-- La directiva @push('scripts') permite agregar este script al final del body--}}
@push('scripts')
    <script src="{{ asset('js/crear_leccion.js') }}"></script>
@endpush
