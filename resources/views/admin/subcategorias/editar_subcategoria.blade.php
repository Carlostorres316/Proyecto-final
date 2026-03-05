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
                    <li class="breadcrumb-item active">Editar: {{ $subcategoria->nombre }}</li>
                </ol>
            </nav>
            
            <h2><i class="bi bi-pencil me-2"></i>Editar Subcategoría</h2>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.subcategorias.update', [$categoria->id, $subcategoria->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Subcategoría</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                       id="nombre" name="nombre" value="{{ old('nombre', $subcategoria->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                          id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $subcategoria->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.subcategorias.index', $categoria->id) }}" class="btn btn-outline-modern">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary-modern">
                    <i class="bi bi-save"></i> Actualizar Subcategoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection