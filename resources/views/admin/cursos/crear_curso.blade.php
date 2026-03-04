@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-plus-circle me-2"></i>Crear Curso</h2>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.cursos.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Curso</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control "  id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">Profesor</label>
                   <select class="form-select" id="user_id" name="user_id" required>
                        <option value="">Seleccione un profesor</option>
                        @foreach($profesores as $profesor)
                            <option value="{{ $profesor->id }}">
                                {{ $profesor->name }} ({{ $profesor->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subcategoria_id" class="form-label">Subcategoría</label>
                    <select class="form-select" id="subcategoria_id" name="subcategoria_id" required>
                        <option value="">Seleccione una subcategoría</option>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" {{ old('subcategoria_id') == $subcategoria->id }}>
                                {{ $subcategoria->nombre }} ({{ $subcategoria->categoria->nombre }})
                            </option>
                        @endforeach
                    </select>
                    @error('subcategoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" min="0" class="form-control " id="precio" name="precio" value="{{ old('precio', 0) }}" required>
                    </div>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nivel" class="form-label">Nivel</label>
                    <select class="form-select @error('nivel') is-invalid @enderror" id="nivel" name="nivel" required>
                        <option value="">Seleccione un nivel</option>
                        <option value="principiante" {{ old('nivel') == 'principiante'  }}>Principiante</option>
                        <option value="intermedio" {{ old('nivel') == 'intermedio'  }}>Intermedio</option>
                        <option value="avanzado" {{ old('nivel') == 'avanzado' }}>Avanzado</option>
                    </select>
                    @error('nivel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.cursos.index') }}" class="btn btn-outline-modern">Cancelar</a>
                <button type="submit" class="btn btn-primary-modern">Crear Curso</button>
            </div>
        </form>
    </div>
</div>
@endsection