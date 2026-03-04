@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-person-lock me-2"></i>Dashboard Administrador</h2>
            <p class="text-muted">Bienvenido, {{ Auth::user()->name }}</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ \App\Models\User::count() }}</div>
                <div class="stat-label">Total Usuarios</div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div class="stat-number">{{ \App\Models\Curso::count() }}</div>
                <div class="stat-label">Total Cursos</div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-tags"></i>
                </div>
                <div class="stat-number">{{ \App\Models\Categorias::count() }}</div>
                <div class="stat-label">Categorías</div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-4"><i class="bi bi-bar-chart-steps me-2"></i>Estadísticas</h4>
        </div>
        
        <!-- Gráfico de Usuarios -->
        <div class="col-md-6 mb-4">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0"><i class="bi bi-people-fill me-2 text-primary"></i>Usuarios</h5>
                    <i class="bi bi-bar-chart-line fs-3 text-primary"></i>
                </div>
                
                @php
                    $totalUsuarios = \App\Models\User::count();
                    $admins = \App\Models\User::where('rol', 'administrador')->count();
                    $profesores = \App\Models\User::where('rol', 'profesor')->count();
                    $estudiantes = \App\Models\User::where('rol', 'estudiante')->count();
                    
                    $adminPorcentaje = $totalUsuarios > 0 ? round(($admins / $totalUsuarios) * 100) : 0;
                    $profesorPorcentaje = $totalUsuarios > 0 ? round(($profesores / $totalUsuarios) * 100) : 0;
                    $estudiantePorcentaje = $totalUsuarios > 0 ? round(($estudiantes / $totalUsuarios) * 100) : 0;
                @endphp
                
                <!-- Barras de usuarios -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span><i class="bi bi-shield-lock text-danger me-1"></i> Administradores</span>
                        <span class="fw-bold">{{ $admins }} ({{ $adminPorcentaje }}%)</span>
                    </div>
                    <div class="progress" style="height: 25px; border-radius: 12px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $adminPorcentaje }}%;" aria-valuenow="{{ $adminPorcentaje }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $adminPorcentaje }}%
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span><i class="bi bi-easel text-warning me-1"></i> Profesores</span>
                        <span class="fw-bold">{{ $profesores }} ({{ $profesorPorcentaje }}%)</span>
                    </div>
                    <div class="progress" style="height: 25px; border-radius: 12px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $profesorPorcentaje }}%;" aria-valuenow="{{ $profesorPorcentaje }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $profesorPorcentaje }}%
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <span><i class="bi bi-backpack text-info me-1"></i> Estudiantes</span>
                        <span class="fw-bold">{{ $estudiantes }} ({{ $estudiantePorcentaje }}%)</span>
                    </div>
                    <div class="progress" style="height: 25px; border-radius: 12px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $estudiantePorcentaje }}%;" aria-valuenow="{{ $estudiantePorcentaje }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $estudiantePorcentaje }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gráfico de Ventas -->
        <div class="col-md-6 mb-4">
            <div class="card-modern p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0"><i class="bi bi-cart-check me-2 text-success"></i>Ventas</h5>
                    <i class="bi bi-pie-chart-fill fs-3 text-success"></i>
                </div>
                
                @php
                    $totalCompras = \App\Models\Compra::count();
                    $ingresos = \App\Models\Compra::sum('precio_pagado');
                    $comprasPagadas = \App\Models\Compra::where('precio_pagado', '>', 0)->count();
                    $comprasGratis = \App\Models\Compra::where('precio_pagado', 0)->count();
                    
                    $pagadasPorcentaje = $totalCompras > 0 ? round(($comprasPagadas / $totalCompras) * 100) : 0;
                    $gratisPorcentaje = $totalCompras > 0 ? round(($comprasGratis / $totalCompras) * 100) : 0;
                @endphp
                
                <div class="text-center mb-4">
                    <div class="d-inline-block position-relative">
                        <div style="width: 120px; height: 120px; margin: 0 auto; position: relative;">
                            <svg viewBox="0 0 36 36" style="width: 120px; height: 120px;">
                                <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                      fill="none" stroke="#e2e8f0" stroke-width="3" />
                                <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                      fill="none" stroke="#10b981" stroke-width="3" 
                                      stroke-dasharray="{{ $pagadasPorcentaje }}, 100" 
                                      stroke-linecap="round" />
                                <circle cx="18" cy="18" r="12" fill="white" />
                                <text x="18" y="20.5" text-anchor="middle" font-size="5" font-weight="bold" fill="#1e293b">{{ $totalCompras }}</text>
                                <text x="18" y="25" text-anchor="middle" font-size="2.5" fill="#64748b">compras</text>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="row text-center mb-4">
                    <div class="col-6">
                        <div class="text-success fw-bold fs-4">{{ $comprasPagadas }}</div>
                        <small class="text-muted">Compras Pagadas</small>
                        <div class="progress mt-2" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $pagadasPorcentaje }}%;"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-secondary fw-bold fs-4">{{ $comprasGratis }}</div>
                        <small class="text-muted">Compras Gratis</small>
                        <div class="progress mt-2" style="height: 8px;">
                            <div class="progress-bar bg-secondary" style="width: {{ $gratisPorcentaje }}%;"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Total de ingresos -->
                <div class="text-center mt-3 p-3" style="background: var(--primary-light); border-radius: 12px;">
                    <span class="text-muted">Ingresos Totales</span>
                    <div class="fw-bold fs-3" style="color: var(--primary-dark);">${{ number_format($ingresos, 2) }}</div>
                </div>
                
                <div class="mt-4">
                    <h6 class="mb-3"><i class="bi bi-clock-history me-2"></i>Últimas compras</h6>
                    @php
                        $ultimasCompras = \App\Models\Compra::with(['estudiante', 'curso'])
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @foreach($ultimasCompras as $compra)
                        <div class="d-flex align-items-center mb-2 pb-2 border-bottom">
                            <div class="flex-shrink-0 me-2">
                                <i class="bi bi-person-circle text-muted"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="fw-bold">{{ $compra->estudiante->name }}</small>
                                <small class="text-muted d-block">{{ $compra->curso->titulo }}</small>
                            </div>
                            <div class="text-end">
                                @if($compra->precio_pagado > 0)
                                    <span class="fw-bold text-success">${{ number_format($compra->precio_pagado, 2) }}</span>
                                @else
                                    <span class="badge bg-secondary">Gratis</span>
                                @endif
                                <small class="text-muted d-block">{{ $compra->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .progress {
        background-color: var(--gray-200);
        border-radius: 12px;
        overflow: hidden;
    }
    
    .progress-bar {
        transition: width 1s ease-in-out;
        font-weight: 500;
    }
</style>
@endpush