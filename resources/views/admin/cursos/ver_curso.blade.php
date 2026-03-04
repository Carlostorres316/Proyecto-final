@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-journal-bookmark-fill me-2"></i>Detalles del Curso</h2>
        </div>
    </div>

    <div class="form-card">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID</label>
                <p class="form-control-plaintext">{{ $curso->id }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Título</label>
                <p class="form-control-plaintext">{{ $curso->titulo }}</p>
            </div>
            
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <p class="form-control-plaintext">{{ $curso->descripcion }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Profesor</label>
                <p class="form-control-plaintext">
                    <a href="{{ route('admin.usuarios.show', $curso->profesor->id) }}">
                        {{ $curso->profesor->name }}
                    </a>
                </p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Subcategoría</label>
                <p class="form-control-plaintext">{{ $curso->subcategoria->nombre ?? 'Sin categoría' }}</p>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Precio</label>
                <p class="form-control-plaintext">${{ number_format($curso->precio, 2) }}</p>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Nivel</label>
                <p class="form-control-plaintext">
                    <span class="badge-nivel {{ $curso->nivel }}">
                        {{ ucfirst($curso->nivel) }}
                    </span>
                </p>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Fecha de Creación</label>
                <p class="form-control-plaintext">{{ $curso->fecha_creacion->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($curso->modulos->count() > 0)
        <div class="mt-4">
            <h5>Módulos y Lecciones</h5>
            @foreach($curso->modulos as $modulo)
                <div class="modulo-item">
                    <h6>{{ $modulo->titulo }}</h6>
                    @if($modulo->lecciones->count() > 0)
                        <div class="ms-3">
                            @foreach($modulo->lecciones as $leccion)
                                <div class="leccion-item">
                                    <i class="bi bi-{{ $leccion->tipo == 'video' ? 'camera-reels' : ($leccion->tipo == 'material' ? 'file-text' : 'question-circle') }} me-2"></i>
                                    {{ $leccion->titulo }}
                                    <span class="badge bg-secondary float-end">{{ ucfirst($leccion->tipo) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted ms-3">Sin lecciones</p>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <div class="mt-4">
            <h5>Estudiantes Inscritos ({{ $curso->compras->count() }})</h5>
            @if($curso->compras->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Precio Pagado</th>
                                <th>Fecha Compra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($curso->compras as $compra)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.usuarios.show', $compra->estudiante->id) }}">
                                            {{ $compra->estudiante->name }}
                                        </a>
                                    </td>
                                    <td>${{ number_format($compra->precio_pagado, 2) }}</td>
                                    <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No hay estudiantes inscritos</p>
            @endif
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.cursos.index') }}" class="btn btn-outline-modern">Volver</a>
            <a href="{{ route('admin.cursos.edit', $curso->id) }}" class="btn btn-primary-modern">Editar</a>
        </div>
    </div>
</div>
@endsection