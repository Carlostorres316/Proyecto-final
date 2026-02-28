@extends('layouts.app')

@section('title', $modulo->titulo)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-modern">
            <li class="breadcrumb-item"><a href="{{ route('profesor.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profesor.cursos.index') }}">Mis Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profesor.modulos.index', $modulo->curso) }}">{{ $modulo->curso->titulo }}</a></li>
            <li class="breadcrumb-item active">{{ $modulo->titulo }}</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $modulo->titulo }}</h3>
            <p>{{ $modulo->descripcion }}</p>
            <span class="badge bg-secondary">Orden: {{ $modulo->orden }}</span>
        </div>
    </div>

    <h4>Lecciones en este módulo</h4>
    <div class="list-group shadow-sm">
        @forelse($modulo->lecciones as $leccion)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $leccion->titulo }}</strong> 
                    <small class="text-uppercase ml-2">({{ $leccion->tipo }})</small>
                </span>
                <div class="btn-group">
                    @if($leccion->tipo == 'video' && $leccion->url_video)
                        <a href="{{ $leccion->url_video }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver Video</a>
                    @elseif($leccion->contenido)
                        <a href="#" class="btn btn-sm btn-outline-primary">Ver Contenido</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="list-group-item">Este módulo aún no tiene lecciones.</div>
        @endforelse
    </div>

    <div class="mt-4">
        <a href="{{ route('profesor.modulos.index', $modulo->curso) }}" class="btn btn-secondary">Regresar al Curso</a>
        <a href="{{ route('profesor.lecciones.create', $modulo) }}" class="btn btn-primary">Agregar Lección</a>
    </div>
</div>
@endsection