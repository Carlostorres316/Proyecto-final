@extends('layouts.app')

@section('title', 'Orden de Compra')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--primary-color);">
                <i class="bi bi-credit-card me-2"></i>
                Orden de Compra
            </h2>
            <p class="text-muted">Completa los datos para finalizar tu compra</p>
        </div>
    </div>

    @php
        // Obtener el carrito de la session
        $carrito = session('carrito', []);
        $total = 0;
        $cursosCarrito = [];
        
        // So lo si hay cursos en el carrito
        if (!empty($carrito)) {
            // consulta a l base de datos
            $cursosCarrito = App\Models\Curso::whereIn('id', $carrito)->get();
            foreach ($cursosCarrito as $curso) {
                $total += $curso->precio;
            }
        }
    @endphp

    @if(empty($carrito))
        <div class="card-modern text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: var(--gray-600);"></i>
            <h4 class="mt-3">No hay cursos en el carrito</h4>
            <a href="{{ route('estudiante.cursos') }}" class="btn-primary-modern mt-3">
                Ir al Catálogo
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="card-modern">
                    <div class="card-header">
                        <h5 class="mb-0">Datos de Pago</h5>
                    </div>
                    <div class="curso-body">
                        <form action="{{ route('estudiante.procesar-compra') }}" method="POST" id="form-compra">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Método de pago</label>
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check card p-3 border rounded">
                                            <input class="form-check-input" type="radio" name="metodo_pago" id="tarjeta" value="tarjeta" checked>
                                            <label class="form-check-label w-100" for="tarjeta">
                                                <i class="bi bi-credit-card fs-4 d-block mb-2" style="color: var(--primary-color);"></i>
                                                <span class="fw-bold">Tarjeta</span>
                                                <small class="d-block text-muted">Crédito o débito</small>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check card p-3 border rounded">
                                            <input class="form-check-input" type="radio" name="metodo_pago" id="paypal" value="paypal">
                                            <label class="form-check-label w-100" for="paypal">
                                                <i class="bi bi-paypal fs-4 d-block mb-2" style="color: var(--primary-color);"></i>
                                                <span class="fw-bold">PayPal</span>
                                                <small class="d-block text-muted">Pago seguro</small>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check card p-3 border rounded">
                                            <input class="form-check-input" type="radio" name="metodo_pago" id="transferencia" value="transferencia">
                                            <label class="form-check-label w-100" for="transferencia">
                                                <i class="bi bi-bank fs-4 d-block mb-2" style="color: var(--primary-color);"></i>
                                                <span class="fw-bold">Transferencia</span>
                                                <small class="d-block text-muted">Bancaria</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Resumen de cursos</label>
                                <div class="bg-light p-3 rounded">
                                    @foreach($cursosCarrito as $curso)
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>{{ $curso->titulo }}</span>
                                            <span class="fw-bold">S/.{{ number_format($curso->precio, 2) }}</span>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">Total a pagar:</span>
                                        <span class="fw-bold" style="color: var(--primary-color); font-size: 1.2rem;">S/.{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="terminos" required>
                                <label class="form-check-label" for="terminos">
                                    Acepto los <a href="#" class="text-primary">términos y condiciones</a> de compra
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern sticky-top" style="top: 20px;">
                        <div class="card-header">
                            <h5 class="mb-0">Confirmar Compra</h5>
                        </div>
                        <div class="curso-body">
                            <div class="text-center mb-4">
                                <i class="bi bi-shield-check" style="font-size: 3rem; color: var(--success-color);"></i>
                                <h6 class="mt-2">Compra segura</h6>
                                <p class="small text-muted">Tus datos están protegidos</p>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" form="form-compra" class="btn-primary-modern" onclick="return confirm('¿Confirmar la compra por S/.{{ number_format($total, 2) }}?')">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Confirmar y Pagar
                                </button>
                                
                                <a href="{{ route('estudiante.carrito') }}" class="btn-outline-modern">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Volver al Carrito
                                </a>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="small text-muted">
                                <i class="bi bi-lock me-1"></i>
                                Pago procesado de forma segura
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endif
</div>
@endsection