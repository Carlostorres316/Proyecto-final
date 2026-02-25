<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function dashboard()
    {
        return view('profesor.dashboard');
    }

    public function vivo()
    {
        return view('profesor.enVivo');
    }

    public function analiticas()
    {
        return view('profesor.analiticas');
    }
}
