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

    Route::get('/estudiante/cursos', [EstudianteController::class, 'cursos'])->name('estudiante.cursos');

    Route::get('/estudiante/mis-cursos', [EstudianteController::class, 'misCursos'])->name('estudiante.mis-cursos');

    Route::get('/estudiante/mis-cursos/{curso}', [EstudianteController::class, 'verCurso'])->name('estudiante.curso.ver');

    Route::get('/estudiante/mis-cursos/{curso}/modulos/{modulo}', [EstudianteController::class, 'verModulo'])->name('estudiante.modulo.ver');

    Route::get('/estudiante/mis-cursos/{curso}/modulos/{modulo}/lecciones/{leccion}', [EstudianteController::class, 'verLeccion'])->name('estudiante.leccion.ver');

    Route::get('/estudiante/enVivo', [EstudianteController::class, 'vivo'])->name('estudiante.vivo');

    Route::get('/estudiante/carrito', [EstudianteController::class, 'carrito'])->name('estudiante.carrito');
    
    Route::get('/estudiante/orden-de-compra', [EstudianteController::class, 'ordenDeCompra'])->name('estudiante.orden-de-compra');

    // Rutas de profesor
    Route::get('/profesor/dashboard', [ProfesorController::class, 'dashboard'])->name('profesor.dashboard');

    Route::get('/profesor/enVivo', [ProfesorController::class, 'vivo'])->name('profesor.enVivo');
    
    //Profesor aqui el route resource para el crud me daba problemas en la signacion de nombres .index asique busque para solucionarlo y encontre esta forma de hacerlo.  
    Route::resource('/profesor/cursos', ProfesorCursoController::class)->names('profesor.cursos');
    
    //Profesor busque y lo mejor es usar rutas anidades para los modulos y lecciones ya que cada modulo pertenece a un curso y cada leccion a un modulo.
    Route::resource('/profesor/cursos/{curso}/modulos', ProfesorModuloController::class)->names('profesor.modulos');

    //Profesor el ->parameters(['lecciones' => 'leccion']) es para que en las rutas de lecciones se use {leccion} en vez de {lecciones} me estaba dando problemas larevel aqui.
    Route::resource('/profesor/modulos/{modulo}/lecciones', ProfesorLeccionController::class)->names('profesor.lecciones')->parameters(['lecciones' => 'leccion']);

    // Rutas de administrador
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');

    Route::resource('/admin/usuarios', AdminUsuarioController::class);
    Route::resource('/admin/cursos', AdminCursoController::class);
    Route::resource('/admin/categorias', AdminCategoriaController::class);    
});
