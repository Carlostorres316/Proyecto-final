<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Curso;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        $categorias = Categorias::with('subcategorias.cursos')->get();

        $cursosDestacados = Curso::with(['profesor', 'subcategoria.categoria'])->latest('fecha_creacion')->take(8)->get();

        $cursosGratis = Curso::with(['profesor', 'subcategoria.categoria'])->where('precio', 0)->inRandomOrder()->take(4)->get();

        $cursosPrincipiantes = Curso::with(['profesor', 'subcategoria.categoria'])->where('nivel', 'principiante')->inRandomOrder()->take(4)->get();

        return view('welcome', compact('categorias', 'cursosDestacados', 'cursosGratis', 'cursosPrincipiantes'));
    }
}