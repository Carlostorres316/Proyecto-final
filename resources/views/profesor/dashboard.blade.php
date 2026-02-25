@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-mortarboard-fill me-2"></i>Dashboard Profesor</h2>
            <p class="text-muted">Bienvenido, {{ Auth::user()->name }}</p>
        </div>
    </div>
    
</div>

@endsection