@extends('layouts.app')

@section('title', 'Clases en Vivo')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                <i class="bi bi-camera-reels me-2"></i>
                Clases en Vivo
            </h2>
            <p class="text-muted">Mira los videos de los profesores</p>
        </div>
    </div>

    {{--Crear nueva clase en vivo--}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-calendar-check me-2"></i>
                    En vivo
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="bi bi-camera-video" style="font-size: 4rem; color: #cbd5e1;"></i>
                        <p class="text-muted">No me alcanzo tiempo a implementarlo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection