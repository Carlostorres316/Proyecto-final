@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-cart-check me-2"></i>Compras de {{ $usuario->name }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.show', $usuario->id) }}">{{ $usuario->name }}</a></li>
                    <li class="breadcrumb-item active">Compras</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-modern">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="stat-number">{{ $usuario->comprasEstudiante->count() }}</div>
                <div class="stat-label">Total Compras</div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="stat-number">${{ number_format($usuario->comprasEstudiante->sum('precio_pagado'), 2) }}</div>
                <div class="stat-label">Total Gastado</div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div class="stat-number">{{ $usuario->comprasEstudiante->where('precio_pagado', '>', 0)->count() }}</div>
                <div class="stat-label">Cursos Pagados</div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                    <i class="bi bi-gift"></i>
                </div>
                <div class="stat-number">{{ $usuario->comprasEstudiante->where('precio_pagado', 0)->count() }}</div>
                <div class="stat-label">Cursos Gratis</div>
            </div>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-header">
            <i class="bi bi-list-check"></i> Historial de Compras
        </div>
        <div class="card-body">
            @if($usuario->comprasEstudiante->count() > 0)
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>ID Compra</th>
                                <th>Curso</th>
                                <th>Precio Pagado</th>
                                <th>Método de Pago</th>
                                <th>Estado</th>
                                <th>Fecha Compra</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuario->comprasEstudiante as $compra)
                            <tr>
                                <td>#{{ $compra->id }}</td>
                                <td>
                                    <a href="{{ route('admin.cursos.show', $compra->curso->id) }}">
                                        {{ $compra->curso->titulo }}
                                    </a>
                                </td>
                                <td>
                                    @if($compra->precio_pagado > 0)
                                        <span class="fw-bold text-success">${{ number_format($compra->precio_pagado, 2) }}</span>
                                    @else
                                        <span class="badge bg-secondary">Gratis</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $compra->metodo_pago == 'gratis' ? 'secondary' : 'info' }}">
                                        {{ ucfirst($compra->metodo_pago) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $compra->estado_pago == 'completado' ? 'success' : 'warning' }}">
                                        {{ ucfirst($compra->estado_pago) }}
                                    </span>
                                </td>
                                <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.cursos.show', $compra->curso->id) }}" class="btn btn-sm btn-outline-modern">
                                        <i class="bi bi-eye"></i> Ver Curso
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bi bi-cart-x" style="font-size: 3rem; color: var(--gray-600);"></i>
                    <p class="mt-3 text-muted">Este estudiante no ha realizado ninguna compra</p>
                    <a href="{{ route('admin.usuarios.show', $usuario->id) }}" class="btn btn-primary-modern">
                        <i class="bi bi-arrow-left"></i> Volver al Usuario
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection