@extends('layouts.app')

@section('title', 'Crear Curso')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--profesor-primary);">
                    <i class="bi bi-plus-circle me-2"></i>
                    Crear Nuevo Curso
                </h2>
                <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-profesor">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            {{-- Formulario --}}
            <div class="form-card">
                <form action="{{ route('profesor.cursos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del Curso</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" 
                                   id="precio" name="precio" value="{{ old('precio') }}" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select class="form-select @error('nivel') is-invalid @enderror" id="nivel" name="nivel" required>
                                <option value="">Selecciona un nivel</option>
                                <option value="principiante" {{ old('nivel') == 'principiante' ? 'selected' : '' }}>Principiante</option>
                                <option value="intermedio" {{ old('nivel') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                <option value="avanzado" {{ old('nivel') == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                            </select>
                            @error('nivel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="subcategoria_id" class="form-label">Subcategoría</label>
                        <select class="form-select @error('subcategoria_id') is-invalid @enderror" 
                                id="subcategoria_id" name="subcategoria_id" required>
                            <option value="">Selecciona una subcategoría</option>
                            @foreach($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id }}" {{ old('subcategoria_id') == $subcategoria->id ? 'selected' : '' }}>
                                    {{ $subcategoria->categoria->nombre }} > {{ $subcategoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-profesor">
                            <i class="bi bi-save me-2"></i>
                            Crear Curso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
