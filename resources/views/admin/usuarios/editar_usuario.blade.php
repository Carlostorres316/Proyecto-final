@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-pencil me-2"></i>Editar Usuario</h2>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control " id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' }}>Administrador</option>
                    <option value="profesor" {{ old('rol', $usuario->rol) == 'profesor' }}>Profesor</option>
                    <option value="estudiante" {{ old('rol', $usuario->rol) == 'estudiante' }}>Estudiante</option>
                </select>
                @error('rol')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-modern">Cancelar</a>
                <button type="submit" class="btn btn-primary-modern">Actualizar Usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection