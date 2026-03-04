@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-people me-2"></i>Usuarios</h2>
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary-modern">
                <i class="bi bi-plus-circle"></i> Nuevo Usuario
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

    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <span class="badge bg-{{ $usuario->rol == 'administrador' ? 'danger' : ($usuario->rol == 'profesor' ? 'warning' : 'info') }}">
                            {{ ucfirst($usuario->rol) }}
                        </span>
                    </td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.show', $usuario->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-outline-modern">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if($usuario->id != Auth::id())
                        <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-modern" onclick="return confirm('¿Estás seguro?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection