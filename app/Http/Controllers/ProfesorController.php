<?php

namespace App\Http\Controllers;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function dashboard()
    {   
        // En el dashboard del profesor, se muestran solo los cursos que pertenecen al profesor autenticado usando el user_id para filtrar los cursos.
        $cursos = Curso::where('user_id', Auth::id())->get();
        return view('profesor.dashboard')->with('cursos', $cursos);
    }

    public function vivo()
    {
        return view('profesor.enVivo');
    }

}
