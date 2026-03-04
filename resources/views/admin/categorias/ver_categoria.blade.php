@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-tags me-2"></i>Detalles de la Categoría</h2>
        </div>
    </div>

    <div class="form-card">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">ID</label>
                <p class="form-control-plaintext">{{ $categoria->id }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <p class="form-control-plaintext">{{ $categoria->nombre }}</p>
            </div>
            
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <p class="form-control-plaintext">{{ $categoria->descripcion }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Fecha de Creación</label>
                <p class="form-control-plaintext">{{ $categoria->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Última Actualización</label>
                <p class="form-control-plaintext">{{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($categoria->subcategorias->count() > 0)
        <div class="mt-4">
            <h5>Subcategorías ({{ $categoria->subcategorias->count() }})</h5>
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cursos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoria->subcategorias as $sub)
                        <tr>
                            <td>{{ $sub->id }}</td>
                            <td>{{ $sub->nombre }}</td>
                            <td>{{ $sub->descripcion}}</td>
                            <td>{{ $sub->cursos->count() }} cursos</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-modern">Volver</a>
            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-primary-modern">Editar</a>
        </div>
    </div>
</div>
@endsection