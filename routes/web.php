<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfesorCursoController;
use App\Http\Controllers\ProfesorModuloController;
use App\Http\Controllers\ProfesorLeccionController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\AdminCursoController;
use App\Http\Controllers\AdminCategoriaController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::middleware('auth')->group(function () {

    // Rutas de estudiante
    Route::get('/estudiante/dashboard', [EstudianteController::class, 'dashboard'])->name('estudiante.dashboard');

    Route::get('/estudiante/cursos', [EstudianteController::class, 'catalogo'])->name('estudiante.cursos'); 

    Route::get('/estudiante/mis-cursos', [EstudianteController::class, 'misCursos'])->name('estudiante.mis-cursos');

    Route::get('/estudiante/mis-cursos/{curso}', [EstudianteController::class, 'verCurso'])->name('estudiante.curso.ver');

    //Profesor busque y es mejor las rutas anidadas para ver los modulos y lecciones de un curso comprado
    Route::get('/estudiante/mis-cursos/{curso}/modulos/{modulo}', [EstudianteController::class, 'verModulo'])->name('estudiante.modulo.ver');

    Route::get('/estudiante/mis-cursos/{curso}/modulos/{modulo}/lecciones/{leccion}', [EstudianteController::class, 'verLeccion'])->name('estudiante.leccion.ver');

    Route::get('/estudiante/enVivo', [EstudianteController::class, 'vivo'])->name('estudiante.enVivo');

    // Rutas de carrito y compra estudiante
    Route::get('/estudiante/carrito', [EstudianteController::class, 'carrito'])->name('estudiante.carrito');
    
    Route::post('/estudiante/carrito/agregar/{curso}', [EstudianteController::class, 'agregarCarrito'])->name('estudiante.carrito.agregar');
    
    Route::delete('/estudiante/carrito/quitar/{curso}', [EstudianteController::class, 'quitarCarrito'])->name('estudiante.carrito.quitar');
    
    Route::post('/estudiante/comprar-curso/{curso}', [EstudianteController::class, 'comprarCurso'])->name('estudiante.comprar-curso');

    Route::get('/estudiante/orden-de-compra', [EstudianteController::class, 'ordenDeCompra'])->name('estudiante.orden-de-compra');
    
    Route::post('/estudiante/procesar-compra', [EstudianteController::class, 'procesarCompra'])->name('estudiante.procesar-compra');

    // Rutas de profesor
    Route::get('/profesor/dashboard', [ProfesorController::class, 'dashboard'])->name('profesor.dashboard');

    Route::get('/profesor/enVivo', [ProfesorController::class, 'vivo'])->name('profesor.enVivo');
    
    Route::resource('/profesor/cursos', ProfesorCursoController::class)->names('profesor.cursos');
    
    Route::resource('/profesor/cursos/{curso}/modulos', ProfesorModuloController::class)->names('profesor.modulos');

    //Profesor utilize parameters porque el larevel me estaba dando problemas para encontrar la leccion, ya que el parametro por defecto era lecciones y no leccion
    Route::resource('/profesor/modulos/{modulo}/lecciones', ProfesorLeccionController::class)->names('profesor.lecciones')->parameters(['lecciones' => 'leccion']);

    // Rutas de administrador
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');

    Route::resource('/admin/usuarios', AdminUsuarioController::class);
    Route::resource('/admin/cursos', AdminCursoController::class);
    Route::resource('/admin/categorias', AdminCategoriaController::class);    
});