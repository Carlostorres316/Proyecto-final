@extends('layouts.app')

@section('title', 'Editar Módulo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $curso) }}">{{ $curso->titulo }}</a></li>
                    <li class="breadcrumb-item active">Editar Módulo</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-pencil me-2"></i>
                    Editar Módulo: {{ $modulo->titulo }}
                </h2>
                <a href="{{ route('profesor.modulos.index', $curso) }}" class="btn-outline-modern">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            <div class="form-card">
                <form action="{{ route('profesor.modulos.update', [$curso, $modulo]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Título</label>
                        <input type="text" name="titulo" class="form-control" value="{{ $modulo->titulo }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" required>{{ $modulo->descripcion }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Orden</label>
                        <input type="number" name="orden" class="form-control" value="{{ $modulo->orden }}">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn-primary-modern py-2">
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