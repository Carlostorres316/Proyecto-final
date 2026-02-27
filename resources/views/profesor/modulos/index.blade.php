@section('title', 'Módulos del Curso')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}" class="text-decoration-none">Mis Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $cursos->titulo }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold" style="color: var(--profesor-primary);">
                        <i class="bi bi-layers me-2"></i>
                        Módulos del Curso
                    </h2>
                    <h5 class="text-muted">{{ $cursos->titulo }}</h5>
                </div>
                <div>
                    <a href="{{ route('profesor.modulos.crear_modulo', $cursos) }}" class="btn-profesor">
                        <i class="bi bi-plus-circle"></i>
                        Nuevo Módulo
                    </a>
                    <a href="{{ route('profesor.cursos.ver_curso', $cursos) }}" class="btn-outline-profesor ms-2">
                        <i class="bi bi-arrow-left"></i>
                        Volver al Curso
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de Módulos --}}
    <div class="row">
        <div class="col-12">
            @forelse($modulos as $modulo)
                <div class="modulo-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-3" style="background: var(--profesor-primary) !important;">
                                <i class="bi bi-{{ $modulo->orden ?? 'question' }}"></i>
                            </span>
                            <div>
                                <h5 class="mb-1">{{ $modulo->titulo }}</h5>
                                <p class="text-muted mb-0">{{ Str::limit($modulo->descripcion, 100) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-camera-reels"></i> {{ $modulo->lecciones->count() }} lecciones
                                </small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('profesor.lecciones.index', $modulo) }}" 
                               class="btn btn-sm btn-outline-profesor" title="Lecciones">
                                <i class="bi bi-list-check"></i>
                            </a>
                            <a href="{{ route('profesor.modulos.ver_modulo', [$cursos, $modulo]) }}" 
                               class="btn btn-sm btn-outline-profesor" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('profesor.modulos.editar_modulo', [$cursos, $modulo]) }}" 
                               class="btn btn-sm btn-outline-profesor" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('profesor.modulos.destroy', [$cursos, $modulo]) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('¿Eliminar este módulo?')" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="profesor-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-layers" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No hay módulos en este curso</h5>
                        <p class="text-muted">Comienza organizando tu curso en módulos</p>
                        <a href="{{ route('profesor.modulos.crear_modulo', $cursos) }}" class="btn-profesor mt-2">
                            <i class="bi bi-plus-circle me-2"></i>Crear Primer Módulo
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
