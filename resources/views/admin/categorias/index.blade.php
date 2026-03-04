@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-tags me-2"></i>Categorías</h2>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary-modern">
                <i class="bi bi-plus-circle"></i> Nueva Categoría
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-modern">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-modern">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @foreach($categorias as $categoria)
        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-folder"></i> {{ $categoria->nombre }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $categoria->descripcion }}</p>
                    
                    @if($categoria->subcategorias->count() > 0)
                        <h6 class="mt-3">Subcategorías:</h6>
                        <ul class="list-group">
                            @foreach($categoria->subcategorias as $sub)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $sub->nombre }}
                                    <span class="badge bg-primary">{{ $sub->cursos->count() }} cursos</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categorias.show', $categoria->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-modern" onclick="return confirm('¿Estás seguro?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection