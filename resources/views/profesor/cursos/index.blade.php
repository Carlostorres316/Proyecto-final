@extends('layouts.app')

@section('title', 'Mis Cursos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold" style="color: var(--profesor-primary);">
                    <i class="bi bi-journals me-2"></i>
                    Mis Cursos
                </h2>
                <a href="{{ route('profesor.cursos.create') }}" class="btn-profesor">
                    <i class="bi bi-plus-circle"></i>
                    Nuevo Curso
                </a>
            </div>
        </div>
    </div>

    {{-- Lista de cursos --}}
    <div class="row">
        @forelse($cursos as $curso)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="curso-card">
                    <div class="curso-img">
                        <span class="curso-badge {{ $curso->nivel }}">
                            {{ ucfirst($curso->nivel) }}
                        </span>
                    </div>
                    <div class="curso-body">
                        <h5 class="curso-titulo">{{ $curso->titulo }}</h5>
                        <p class="curso-descripcion">{{ Str::limit($curso->descripcion, 80) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-journal"></i> {{ $curso->modulos->count() }} módulos
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-people"></i> {{ $curso->compras->count() }} estudiantes
                            </span>
                        </div>
                        
                        <div class="curso-footer">
                            <span class="curso-precio">${{ number_format($curso->precio, 2) }}</span>
                            <div class="btn-group">
                                <a href="{{ route('profesor.cursos.show', $curso) }}" class="btn btn-sm btn-outline-profesor" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('profesor.cursos.edit', $curso) }}" class="btn btn-sm btn-outline-profesor" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-profesor" title="Módulos"
                                        onclick="window.location='{{ route('profesor.modulos.index', $curso) }}'">
                                    <i class="bi bi-layers"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="profesor-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-journal-x" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No tienes cursos creados</h5>
                        <p class="text-muted">Comienza creando tu primer curso ahora</p>
                        <a href="{{ route('profesor.cursos.create') }}" class="btn-profesor mt-2">
                            <i class="bi bi-plus-circle me-2"></i>Crear Curso
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
