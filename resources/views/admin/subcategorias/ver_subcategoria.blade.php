@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('admin.categorias.index') }}">Categorías</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.subcategorias.index', $categoria->id) }}">
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $subcategoria->nombre }}</li>
                </ol>
            </nav>
            
            <h2><i class="bi bi-tag me-2"></i>Detalles de Subcategoría</h2>
        </div>
    </div>

    <div class="form-card">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID</label>
                <p class="form-control-plaintext">{{ $subcategoria->id }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <p class="form-control-plaintext">{{ $subcategoria->nombre }}</p>
            </div>
            
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <p class="form-control-plaintext">{{ $subcategoria->descripcion ?: 'Sin descripción' }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Categoría Principal</label>
                <p class="form-control-plaintext">
                    <a href="{{ route('admin.categorias.show', $categoria->id) }}">
                        {{ $categoria->nombre }}
                    </a>
                </p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Total Cursos</label>
                <p class="form-control-plaintext">
                    <span class="badge bg-primary">{{ $subcategoria->cursos->count() }} cursos</span>
                </p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha de Creación</label>
                <p class="form-control-plaintext">{{ $subcategoria->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Última Actualización</label>
                <p class="form-control-plaintext">{{ $subcategoria->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($subcategoria->cursos->count() > 0)
        <div class="mt-4">
            <h5>Cursos en esta Subcategoría ({{ $subcategoria->cursos->count() }})</h5>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Profesor</th>
                            <th>Precio</th>
                            <th>Nivel</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategoria->cursos as $curso)
                        <tr>
                            <td>{{ $curso->id }}</td>
                            <td>{{ $curso->titulo }}</td>
                            <td>{{ $curso->profesor->name }}</td>
                            <td>${{ number_format($curso->precio, 2) }}</td>
                            <td>
                                <span class="badge-nivel {{ $curso->nivel }}">
                                    {{ ucfirst($curso->nivel) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.cursos.show', $curso->id) }}" 
                                   class="btn btn-sm btn-outline-modern">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.subcategorias.index', $categoria->id) }}" class="btn btn-outline-modern">
                Volver
            </a>
            <a href="{{ route('admin.subcategorias.edit', [$categoria->id, $subcategoria->id]) }}" 
               class="btn btn-primary-modern">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection