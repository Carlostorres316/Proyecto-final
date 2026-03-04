@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-person me-2"></i>Detalles del Usuario</h2>
        </div>
    </div>

    <div class="form-card">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID</label>
                <p class="form-control-plaintext">{{ $usuario->id }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <p class="form-control-plaintext">{{ $usuario->name }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <p class="form-control-plaintext">{{ $usuario->email }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Rol</label>
                <p class="form-control-plaintext">
                    <span class="badge bg-{{ $usuario->rol == 'administrador' ? 'danger' : ($usuario->rol == 'profesor' ? 'warning' : 'info') }}">
                        {{ ucfirst($usuario->rol) }}
                    </span>
                </p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha de Registro</label>
                <p class="form-control-plaintext">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Última Actualización</label>
                <p class="form-control-plaintext">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($usuario->rol == 'estudiante')
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Cursos Comprados</h5>
                <a href="{{ route('admin.usuarios.compras', $usuario->id) }}" class="btn btn-primary-modern btn-sm">
                    <i class="bi bi-cart-check"></i> Ver todas las compras
                </a>
            </div>
            @if($usuario->comprasEstudiante->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Precio Pagado</th>
                                <th>Fecha Compra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuario->comprasEstudiante->take(5) as $compra)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.cursos.show', $compra->curso->id) }}">
                                            {{ $compra->curso->titulo }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($compra->precio_pagado > 0)
                                            ${{ number_format($compra->precio_pagado, 2) }}
                                        @else
                                            <span class="badge bg-secondary">Gratis</span>
                                        @endif
                                    </td>
                                    <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($usuario->comprasEstudiante->count() > 5)
                        <p class="text-muted text-center mt-2">
                            <a href="{{ route('admin.usuarios.compras', $usuario->id) }}">
                                Ver las {{ $usuario->comprasEstudiante->count() }} compras...
                            </a>
                        </p>
                    @endif
                </div>
            @else
                <p class="text-muted">No ha comprado ningún curso</p>
            @endif
        </div>
        @endif

        @if($usuario->rol == 'profesor')
        <div class="mt-4">
            <h5>Cursos Creados</h5>
            @if($usuario->cursosProfesor->count() > 0)
                <ul class="list-group">
                    @foreach($usuario->cursosProfesor as $curso)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.cursos.show', $curso->id) }}">
                                {{ $curso->titulo }}
                            </a>
                            <span class="badge bg-success">{{ $curso->compras->count() }} estudiantes</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No ha creado ningún curso</p>
            @endif
        </div>
        @endif

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-modern">Volver</a>
            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-primary-modern">Editar</a>
        </div>
    </div>
</div>
@endsection