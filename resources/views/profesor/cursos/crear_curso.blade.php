@extends('layouts.app')

@section('title', 'Crear Nuevo Curso')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-color);">
                    <i class="bi bi-plus-circle me-2"></i> Crear Nuevo Curso
                </h2>
                <a href="{{ route('profesor.cursos.index') }}" class="btn-outline-modern">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form action="{{ route('profesor.cursos.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Categoría Principal</label>
                            <select id="categoria_id" class="form-select border-primary">
                                <option value="">-- Selecciona una categoría --</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Subcategoría</label>
                            <select name="subcategoria_id" id="subcategoria_id" class="form-select border-primary" required disabled>
                                <option value="">-- Selecciona primero una categoría --</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Título del Curso</label>
                        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror" required>{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipo de Curso</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_precio" id="gratis" value="gratis" checked>
                                    <label class="form-check-label" for="gratis">
                                        <i class="bi bi-gift text-success"></i> Gratis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_precio" id="pago" value="pago">
                                    <label class="form-check-label" for="pago">
                                        <i class="bi bi-currency-dollar text-primary"></i> De Pago
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3" id="precioContainer" style="display: none;">
                            <label class="form-label fw-bold">Precio (S/.)</label>
                            <div class="input-group">
                                <span class="input-group-text">S/.</span>
                                <input type="number" name="precio" step="0.01" min="0" class="form-control" value="{{ old('precio', '0.00') }}">
                            </div>
                            <small class="text-muted">Ingresa el precio del curso</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nivel</label>
                            <select name="nivel" class="form-select">
                                <option value="principiante">Principiante</option>
                                <option value="intermedio">Intermedio</option>
                                <option value="avanzado">Avanzado</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-primary-modern py-2">Guardar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Se pasa la variable de subcategorías al script para que pueda cargar las subcategorías correspondientes a la categoría seleccionada --}}
<script>
    window.subcategoriasData = @json($subcategorias);
</script>
{{-- Se incluyen los scripts para manejar la lógica de mostrar/ocultar el campo de precio y cargar las subcategorías dinámicamente --}}
@push('scripts')
    <script src="{{ asset('js/crear_curso.js') }}"></script>
    <script src="{{ asset('js/crear_precio.js') }}"></script>
@endpush
@endsection