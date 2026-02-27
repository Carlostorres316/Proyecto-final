@extends('layouts.app')

@section('title', 'Editar Módulo')

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
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $cursos) }}" class="text-decoration-none">{{ $cursos->titulo }}</a></li>
                    <li class="breadcrumb-item active">Editar Módulo</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--profesor-primary);">
                    <i class="bi bi-pencil me-2"></i>
                    Editar Módulo
                </h2>
                <a href="{{ route('profesor.modulos.index', $cursos) }}" class="btn-outline-profesor">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            {{-- Formulario --}}
            <div class="form-card">
                <form action="{{ route('profesor.modulos.update', [$cursos, $modulo]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del Módulo</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo', $modulo->titulo) }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $modulo->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="orden" class="form-label">Orden</label>
                        <input type="number" class="form-control @error('orden') is-invalid @enderror" 
                               id="orden" name="orden" value="{{ old('orden', $modulo->orden) }}">
                        @error('orden')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-profesor">
                            <i class="bi bi-save me-2"></i>
                            Actualizar Módulo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
