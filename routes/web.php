<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dashboard principal
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para Estudiantes
Route::prefix('estudiante')->name('estudiante.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('estudiante.dashboard');
    })->name('dashboard');
    
    Route::get('/cursos', function () {
        return view('estudiante.cursos');
    })->name('cursos');
    
    Route::get('/mis-cursos', function () {
        return view('estudiante.mis-cursos');
    })->name('mis-cursos');
    
    Route::get('/carrito', function () {
        return view('estudiante.carrito');
    })->name('carrito');
    
    Route::get('/curso/{id}', function ($id) {
        return view('estudiante.ver-curso', ['cursoId' => $id]);
    })->name('ver-curso');
});

// Rutas para Profesores
Route::prefix('profesor')->name('profesor.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('profesor.dashboard');
    })->name('dashboard');
    
    Route::get('/cursos', function () {
        return view('profesor.cursos');
    })->name('cursos');
    
    Route::get('/crear-curso', function () {
        return view('profesor.crear-curso');
    })->name('crear-curso');
    
    Route::get('/editar-curso/{id}', function ($id) {
        return view('profesor.editar-curso', ['cursoId' => $id]);
    })->name('editar-curso');
    
    Route::get('/clases-en-vivo', function () {
        return view('profesor.clases-vivo');
    })->name('clases-vivo');
});

// Rutas para Administrador
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/usuarios', function () {
        return view('admin.usuarios');
    })->name('usuarios');
    
    Route::get('/cursos', function () {
        return view('admin.cursos');
    })->name('cursos');
    
    Route::get('/reportes', function () {
        return view('admin.reportes');
    })->name('reportes');
});