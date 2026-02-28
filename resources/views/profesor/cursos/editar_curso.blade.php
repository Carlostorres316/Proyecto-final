@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-modern">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
                    <li class="breadcrumb-item active">Editar Curso</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-pencil me-2"></i>Editar Curso
                </h2>
                <div class="d-flex gap-2">
                    <form action="{{ route('profesor.cursos.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline-modern">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>

                    <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-modern">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="form-card">
                <form action="{{ route('profesor.cursos.update', $curso) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoría</label>
                        <select id="categoria_id" class="form-select">
                            <option value="">-- Selecciona Categoría --</option>
                            @foreach($categorias as $cat)
                                {{-- Se muestra la categoría del curso como seleccionada, para que el profesor vea la categoría actual del curso --}}
                                <option value="{{ $cat->id }}" {{ $curso->subcategoria->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="subcategoria_id" class="form-label fw-bold">Subcategoría</label>
                        <select name="subcategoria_id" id="subcategoria_id" class="form-select @error('subcategoria_id') is-invalid @enderror" required>
                            <option value="{{ $curso->subcategoria_id }}" selected>
                                {{ $curso->subcategoria->nombre }}
                            </option>
                        </select>
                        @error('subcategoria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label fw-bold">Título del Curso</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" name="titulo" value="{{ old('titulo', $curso->titulo) }}" required>
                        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
                        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipo de Curso</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_precio" id="gratis" value="gratis" 
                                        {{ $curso->precio == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gratis">
                                        <i class="bi bi-gift text-success"></i> Gratis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_precio" id="pago" value="pago"
                                        {{ $curso->precio > 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pago">
                                        <i class="bi bi-currency-dollar text-primary"></i> De Pago
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3" id="precioContainer" style="{{ $curso->precio > 0 ? 'display:block' : 'display:none' }}">
                            <label for="precio" class="form-label fw-bold">Precio (S/.)</label>
                            <div class="input-group">
                                <span class="input-group-text">S/.</span>
                                <input type="number" name="precio" step="0.01" min="0" class="form-control @error('precio') is-invalid @enderror" 
                                       id="precio" value="{{ old('precio', $curso->precio) }}">
                            </div>
                            @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nivel" class="form-label fw-bold">Nivel</label>
                            <select class="form-select @error('nivel') is-invalid @enderror" id="nivel" name="nivel" required>
                                <option value="principiante" {{ old('nivel', $curso->nivel) == 'principiante' ? 'selected' : '' }}>Principiante</option>
                                <option value="intermedio" {{ old('nivel', $curso->nivel) == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                <option value="avanzado" {{ old('nivel', $curso->nivel) == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-primary-modern py-2">
                            <i class="bi bi-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.subcategoriasData = @json($subcategorias);
</script>

@push('scripts')
    <script src="{{ asset('js/editar_curso.js') }}"></script>
    <script src="{{ asset('js/crear_precio.js') }}"></script>
@endpush
@endsection