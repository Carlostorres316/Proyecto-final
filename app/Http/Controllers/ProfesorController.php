<?php

namespace App\Http\Controllers;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function dashboard()
    {   
        $cursos = Curso::where('user_id', Auth::id())->get();
        return view('profesor.dashboard')->with('cursos', $cursos);
    }

    public function vivo()
    {
        return view('profesor.enVivo');
    }

}
