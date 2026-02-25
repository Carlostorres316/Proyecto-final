<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{   
    public function dashboard()
    {
        return view('estudiante.dashboard');
    }
    
    public function cursos()
    {
        return view('estudiante.cursos');
    }

    public function misCursos()
    {
        return view('estudiante.mis-cursos');
    }

    public function vivo()
    {
        return view('estudiante.enVivo');
    }

     public function carrito()
    {
        return view('estudiante.carrito');
    }
}
