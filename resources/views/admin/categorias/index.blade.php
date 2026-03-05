@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-tags me-2"></i>Categorías</h2>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary-modern-light">
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-folder"></i> {{ $categoria->nombre }}</span>
                    <span class="badge bg-light text-dark">{{ $categoria->subcategorias->count() }} subcategorías</span>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $categoria->descripcion ?: 'Sin descripción' }}</p>
                    
                    @if($categoria->subcategorias->count() > 0)
                        <h6 class="mt-3"><i class="bi bi-diagram-2 me-2"></i>Subcategorías:</h6>
                        <ul class="list-group mb-3">
                            @foreach($categoria->subcategorias->take(3) as $sub)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.subcategorias.show', [$categoria->id, $sub->id]) }}" 
                                       class="text-decoration-none">
                                        {{ $sub->nombre }}
                                    </a>
                                </li>   
                            @endforeach
                            @if($categoria->subcategorias->count() > 3)
                                <li class="list-group-item text-muted">
                                    <a href="{{ route('admin.subcategorias.index', $categoria->id) }}" 
                                       class="text-decoration-none">
                                        Ver las {{ $categoria->subcategorias->count() }} subcategorías...
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                    
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.subcategorias.index', $categoria->id) }}" 
                           class="btn btn-sm btn-primary-modern-light">
                            <i class="bi bi-diagram-2"></i> Gestionar Subcategorías
                        </a>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.categorias.show', $categoria->id) }}" 
                               class="btn btn-sm btn-outline-modern" title="Ver detalles">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" 
                               class="btn btn-sm btn-outline-modern" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-modern" 
                                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                        title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection