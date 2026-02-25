<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->rol == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->rol == 'profesor') {
            return redirect()->route('profesor.dashboard');
        } else {
            return redirect()->route('estudiante.dashboard');
        }
    }
}

