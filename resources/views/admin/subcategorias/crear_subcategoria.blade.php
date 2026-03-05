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
                    <li class="breadcrumb-item active">Nueva Subcategoría</li>
                </ol>
            </nav>
            
            <h2><i class="bi bi-plus-circle me-2"></i>Crear Subcategoría en "{{ $categoria->nombre }}"</h2>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.subcategorias.store', $categoria->id) }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Subcategoría</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                       id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Ej: "Desarrollo Web", "Marketing Digital", "Diseño Gráfico"</small>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                          id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Describe brevemente esta subcategoría (opcional)</small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.subcategorias.index', $categoria->id) }}" class="btn btn-outline-modern">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary-modern">
                    <i class="bi bi-save"></i> Crear Subcategoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection