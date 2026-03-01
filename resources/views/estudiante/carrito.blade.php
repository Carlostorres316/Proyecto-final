@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                <i class="bi bi-cart-fill me-2"></i>
                Carrito de Compras
            </h2>
            <p class="text-muted">Revisa los cursos que has seleccionado antes de continuar</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-modern mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif
    
    @php
        // Profesor esto no lo vimos en clase pero es para mostrar los cursos que el usuario ha agregado al carrito y calcular el total
        $carrito = session('carrito', []);
        $total = 0;
        $cursosCarrito = [];
        
        // Si el carrito no está vacío, obtenemos los cursos y calculamos el total
        if (!empty($carrito)) {
            // Obtener los cursos que están en el carrito
            $cursosCarrito = App\Models\Curso::whereIn('id', $carrito)->get();
            foreach ($cursosCarrito as $curso) {
                $total += $curso->precio;
            }
        }
    @endphp

    @if(empty($carrito))
        <div class="card-modern text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: var(--gray-600);"></i>
            <h4 class="mt-3">Tu carrito está vacío</h4>
            <p class="text-muted">Agrega cursos desde el catálogo para continuar</p>
            <a href="{{ route('estudiante.cursos') }}" class="btn-primary-modern mt-3">
                <i class="bi bi-book me-2"></i>
                Ver Catálogo
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card-modern mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cursos seleccionados ({{ count($carrito) }})</h5>
                        <span style="color: #fcfcfc">Total: <span class="fw-bold" style="color: #fcfcfc">${{ number_format($total, 2) }}</span></span>
                    </div>
                    <div class="curso-body">
                        @foreach($cursosCarrito as $curso)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <span class="badge-nivel {{ $curso->nivel }}">{{ ($curso->nivel) }}</span>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $curso->titulo }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-person-circle me-1"></i>
                                            {{ $curso->profesor->name ?? 'Instructor' }}
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="fw-bold me-3">S/.{{ number_format($curso->precio, 2) }}</span>
                                    <form action="{{ route('estudiante.carrito.quitar', $curso) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline-modern btn-sm" onclick="return confirm('¿Eliminar este curso del carrito?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('estudiante.cursos') }}" class="btn-outline-modern">
                        <i class="bi bi-arrow-left me-2"></i>
                        Seguir Comprando
                    </a>
                    
                    <a href="{{ route('estudiante.orden-de-compra') }}" class="btn-primary-modern">
                        Proceder al Pago <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection