@extends('layouts.app')

@section('title', 'Clases en Vivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profesor.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--profesor-primary);">
                <i class="bi bi-camera-reels me-2"></i>
                Clases en Vivo
            </h2>
            <p class="text-muted">Programa y gestiona tus clases en vivo</p>
        </div>
    </div>

    {{-- Próximas clases --}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="profesor-card">
                <div class="card-header">
                    <i class="bi bi-calendar-check me-2"></i>
                    Próximas Clases
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="bi bi-camera-video" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">Próximamente</h5>
                        <p class="text-muted">Esta función estará disponible pronto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Clases grabadas --}}
    <div class="row">
        <div class="col-12">
            <div class="profesor-card">
                <div class="card-header">
                    <i class="bi bi-collection-play me-2"></i>
                    Clases Grabadas
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="bi bi-camera-reels" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <h5 class="mt-3">No hay clases grabadas</h5>
                        <p class="text-muted">Las clases que grabes aparecerán aquí</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

