<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    // Redirige al usuario a su dashboard correspondiente según su rol
    public function index()
    {
        $user = Auth::user();
        
        if ($user->rol == 'administrador') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->rol == 'profesor') {
            return redirect()->route('profesor.dashboard');
        } else {
            return redirect()->route('estudiante.dashboard');
        }
    }
}

