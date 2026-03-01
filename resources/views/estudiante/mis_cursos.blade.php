@extends('layouts.app')

@section('title', 'Mis Cursos')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4" style="color: var(--primary-color);">
        <i class="bi bi-collection-play me-2"></i>
        Mis Cursos
    </h2>

    <div class="row">
        @forelse($cursos as $compra)
            <div class="col-md-4 mb-4">
                <div class="curso-card h-100">
                    <div class="curso-body">
                        <h5 class="curso-titulo">
                            {{ $compra->curso->titulo }}
                        </h5>

                        <p class="curso-descripcion">
                            {{ Str::limit($compra->curso->descripcion, 100) }}
                        </p>

                        <a href="{{ route('estudiante.curso.ver', $compra->curso) }}"
                           class="btn-primary-modern w-100 mt-2">
                            <i class="bi bi-play-circle me-2"></i>
                            Continuar Curso
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern text-center py-5">
                    <h5>No estás inscrito en ningún curso</h5>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
