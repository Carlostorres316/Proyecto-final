@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('admin.categorias.index') }}">Categorías</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $categoria->nombre }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="bi bi-tags me-2"></i>
                    Subcategorías de "{{ $categoria->nombre }}"
                </h2>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-modern">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('admin.subcategorias.create', $categoria->id) }}" class="btn btn-primary-modern-light">
                        <i class="bi bi-plus-circle"></i> Nueva Subcategoría
                    </a>
                </div>
            </div>
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
        @forelse($subcategorias as $subcategoria)
        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-folder"></i> {{ $subcategoria->nombre }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $subcategoria->descripcion ?: 'Sin descripción' }}</p>
                    
                    <div class="mt-3">
                        <h6><i class="bi bi-journal-bookmark-fill me-2"></i>Cursos ({{ $subcategoria->cursos->count() }})</h6>
                        @if($subcategoria->cursos->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($subcategoria->cursos->take(3) as $curso)
                                    <li class="list-group-item px-0">
                                        <a href="{{ route('admin.cursos.show', $curso->id) }}">
                                            {{ $curso->titulo }}
                                        </a>
                                    </li>
                                @endforeach
                                @if($subcategoria->cursos->count() > 3)
                                    <li class="list-group-item px-0 text-muted">
                                        Y {{ $subcategoria->cursos->count() - 3 }} cursos más...
                                    </li>
                                @endif
                            </ul>
                        @else
                            <p class="text-muted">No hay cursos en esta subcategoría</p>
                        @endif
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.subcategorias.show', [$categoria->id, $subcategoria->id]) }}" 
                           class="btn btn-sm btn-outline-modern" title="Ver detalles">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.subcategorias.edit', [$categoria->id, $subcategoria->id]) }}" 
                           class="btn btn-sm btn-outline-modern" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.subcategorias.destroy', [$categoria->id, $subcategoria->id]) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-modern" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta subcategoría?')"
                                    title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-folder" style="font-size: 4rem; color: var(--gray-400);"></i>
                <h4 class="mt-3 text-muted">No hay subcategorías</h4>
                <p class="text-muted">Comienza creando una nueva subcategoría para "{{ $categoria->nombre }}"</p>
                <a href="{{ route('admin.subcategorias.create', $categoria->id) }}" class="btn btn-primary-modern-light">
                    <i class="bi bi-plus-circle"></i> Crear Subcategoría
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection