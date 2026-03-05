<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) { 
            return redirect()->route('welcome');
        }

        // Redirige según el rol del usuario
        switch(Auth::user()->rol) { 
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'profesor':
                return redirect()->route('profesor.dashboard');
            case 'estudiante':
                return redirect()->route('estudiante.dashboard');
            default:
                return redirect()->route('welcome');
        }
    }
}