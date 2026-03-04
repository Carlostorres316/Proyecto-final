@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-journal-bookmark-fill me-2"></i>Cursos</h2>
            <a href="{{ route('admin.cursos.create') }}" class="btn btn-primary-modern">
                <i class="bi bi-plus-circle"></i> Nuevo Curso
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-modern">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Profesor</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    <td>{{ $curso->titulo }}</td>
                    <td>{{ $curso->profesor->name }}</td>
                    <td>{{ $curso->subcategoria->nombre ?? 'Sin categoría' }}</td>
                    <td>${{ number_format($curso->precio, 2) }}</td>
                    <td>
                        <span class="badge-nivel {{ $curso->nivel }}">
                            {{ ucfirst($curso->nivel) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.cursos.show', $curso->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.cursos.edit', $curso->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-modern" onclick="return confirm('¿Estás seguro?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection