<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Subcategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $cursos = Curso::where('user_id', Auth::id())->get();
        return view('profesor.cursos.index')->with('cursos', $cursos);
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {   
        $subcategorias = Subcategorias::with('categoria')->get();
        return view('profesor.cursos.crear_curso')->with('subcategorias', $subcategorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        Curso::create([
            'user_id' => Auth::id(),
            'subcategoria_id' => $request->subcategoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'nivel' => $request->nivel,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('profesor.cursos.index')->with('Alamacenado','Curso creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cursos=Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('profesor.cursos.ver_curso')->with('curso', $cursos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        //Profesor el firstOrFail para asegurarnos de que el curso existe y pertenece al profesor autenticado sino lanzará una 404
        $cursos= Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        return view('profesor.cursos.editar_curso')->with('curso', $cursos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cursos = Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        $cursos->update($request->all());

        return redirect()->route('profesor.cursos')->with('Creado','Curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cursos = Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cursos->delete();

        return redirect()->route('profesor.cursos')->with('Curso eliminado exitosamente');
    }
}
