@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-graph-up me-2"></i>Reportes</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-people"></i> Usuarios por Rol
                </div>
                <div class="card-body">
                    @php
                        $totalUsuarios = \App\Models\User::count();
                        $admins = \App\Models\User::where('rol', 'administrador')->count();
                        $profesores = \App\Models\User::where('rol', 'profesor')->count();
                        $estudiantes = \App\Models\User::where('rol', 'estudiante')->count();
                    @endphp
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Administradores
                            <span class="badge bg-danger rounded-pill">{{ $admins }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Profesores
                            <span class="badge bg-warning rounded-pill">{{ $profesores }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Estudiantes
                            <span class="badge bg-info rounded-pill">{{ $estudiantes }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Total
                            <span class="badge bg-primary rounded-pill">{{ $totalUsuarios }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-journal-bookmark-fill"></i> Cursos por Nivel
                </div>
                <div class="card-body">
                    @php
                        $totalCursos = \App\Models\Curso::count();
                        $principiantes = \App\Models\Curso::where('nivel', 'principiante')->count();
                        $intermedios = \App\Models\Curso::where('nivel', 'intermedio')->count();
                        $avanzados = \App\Models\Curso::where('nivel', 'avanzado')->count();
                    @endphp
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Principiante
                            <span class="badge bg-success rounded-pill">{{ $principiantes }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Intermedio
                            <span class="badge bg-warning rounded-pill">{{ $intermedios }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Avanzado
                            <span class="badge bg-danger rounded-pill">{{ $avanzados }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Total
                            <span class="badge bg-primary rounded-pill">{{ $totalCursos }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-cart"></i> Ventas
                </div>
                <div class="card-body">
                    @php
                        $totalCompras = \App\Models\Compra::count();
                        $ingresosTotales = \App\Models\Compra::sum('precio_pagado');
                        $comprasGratis = \App\Models\Compra::where('precio_pagado', 0)->count();
                        $comprasPagadas = \App\Models\Compra::where('precio_pagado', '>', 0)->count();
                    @endphp
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Compras
                            <span class="badge bg-primary rounded-pill">{{ $totalCompras }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Compras Pagadas
                            <span class="badge bg-success rounded-pill">{{ $comprasPagadas }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Compras Gratis
                            <span class="badge bg-info rounded-pill">{{ $comprasGratis }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Ingresos Totales
                            <span class="badge bg-warning rounded-pill">${{ number_format($ingresosTotales, 2) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card-modern">
                <div class="card-header">
                    <i class="bi bi-trophy"></i> Top Profesores
                </div>
                <div class="card-body">
                    @php
                        $topProfesores = \App\Models\User::where('rol', 'profesor')
                            ->withCount('cursosProfesor')
                            ->orderBy('cursos_profesor_count', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    @if($topProfesores->count() > 0)
                        <ul class="list-group">
                            @foreach($topProfesores as $profesor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $profesor->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $profesor->cursos_profesor_count }} cursos</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay profesores registrados</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection