@extends('layouts.app')

@section('title', 'Dashboard Estudiante')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                <i class="bi bi-grid me-2"></i>
                Dashboard
            </h2>
            <p class="text-muted">¡Bienvenido de vuelta, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    @php
        // Profesor aquí se obtienen las compras del estudiante para mostrar estadísticas en el dashboard
        $compras = Auth::user()->comprasEstudiante()->with('curso')->get();
        $cursosEnProgreso = $compras->take(3);
        $totalCursos = $compras->count();
    @endphp

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-number">{{ $totalCursos }}</div>
                <div class="stat-label">Cursos Inscritos</div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="bi bi-play-circle"></i>
                </div>
                @php
                    $totalLecciones = 0;
                    foreach($compras as $compra) {
                        if($compra->curso && $compra->curso->modulos) {
                            foreach($compra->curso->modulos as $modulo) {
                                $totalLecciones += $modulo->lecciones->count();
                            }
                        }
                    }
                @endphp
                <div class="stat-number">{{ $totalLecciones }}</div>
                <div class="stat-label">Lecciones Disponibles</div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="bi bi-trophy"></i>
                </div>
                @php
                    $progresoPromedio = $totalLecciones > 0 ? rand(30, 80) : 0;
                @endphp
                <div class="stat-number">{{ $progresoPromedio }}%</div>
                <div class="stat-label">Progreso Promedio</div>
            </div>
        </div>
    </div>

    <!-- Cursos en Progreso -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Continuar Aprendiendo</h4>
                <a href="{{ route('estudiante.mis-cursos') }}" class="btn-outline-modern btn-sm">
                    Ver todos <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        @forelse($cursosEnProgreso as $compra)
            <div class="col-md-4 mb-3">
                <div class="curso-card">
                    <div class="curso-body">
                        <h5 class="curso-titulo">{{ $compra->curso->titulo }}</h5>
                        <p class="curso-descripcion">{{ Str::limit($compra->curso->descripcion, 80) }}</p>
                        
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ rand(20, 90) }}%; background: var(--primary-color);"></div>
                        </div>
                        
                        <a href="{{ route('estudiante.curso.ver', $compra->curso) }}" class="btn-primary-modern w-100">
                            <i class="bi bi-play-circle me-2"></i>
                            Continuar
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern text-center py-4">
                    <p class="mb-3">Aún no estás inscrito en ningún curso</p>
                    <a href="{{ route('estudiante.cursos') }}" class="btn-primary-modern">
                        Explorar Catálogo
                    </a>
                </div>
            </div>
        @endforelse
</div>
@endsection